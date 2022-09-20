<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

if (app()->environment() != 'production') {
    Route::get('doc/db-schema', function () {
        $filename = config('app.name').' Database Schema.md';
        $filepath = config('database.doc_schema_path').DIRECTORY_SEPARATOR.$filename;

        abort_if(! file_exists($filepath), 404, 'Database schema document not yet generated. Do run php artisan db:schema to generate the schema document.');

        return view('markdown', [
            'content' => Str::markdown(
                file_get_contents(
                    $filepath
                )
            ),
        ]);
    });
}
