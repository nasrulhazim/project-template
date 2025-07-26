<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;

if (! function_exists('upload_media_file')) {
    /**
     * Upload a file to a media collection with optional idempotency.
     *
     * @param  HasMedia  $model  The model using Spatie Media Library
     * @param  UploadedFile  $file  The file to upload
     * @param  string  $collection  Media collection name (default: 'default')
     * @param  bool  $idempotent  Avoid re-uploading same file content (default: true)
     * @return string URL or path of uploaded media
     */
    function upload_media_file(
        HasMedia $model,
        UploadedFile $file,
        string $collection = 'default',
        bool $idempotent = true
    ): string {
        $filename = $file->getClientOriginalName();
        $incomingHash = hash_file('sha256', $file->getRealPath());

        if ($idempotent) {
            $existing = $model->getMedia($collection)->first(function ($media) use ($incomingHash) {
                if (! file_exists($media->getPath())) {
                    return false;
                }

                return hash_file('sha256', $media->getPath()) === $incomingHash;
            });

            if ($existing) {
                return $existing->getUrl();
            }
        }

        return $model->addMedia($file)
            ->usingName(pathinfo($filename, PATHINFO_FILENAME))
            ->usingFileName(Str::random(10).'_'.$filename)
            ->toMediaCollection($collection)
            ->getUrl();
    }
}
