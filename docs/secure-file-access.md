# Laravel Media Secure

This project using Laravel Media Secure version 3.0.0 to protect your media files from unauthorised access. Use this package to enforce access rules via Laravel Policies.

## ✅ Step 1: Define a Policy on Your Model

```bash
php artisan make:policy DocumentPolicy --model=Document
```

Then define:

```php
public function view(User $user, Document $document): bool
{
    return $user->id === $document->user_id;
}

public function stream(User $user, Document $document): bool
{
    return $user->id === $document->user_id;
}

public function download(User $user, Document $document): bool
{
    return $user->id === $document->user_id;
}
```

And register it in `AuthServiceProvider`:

```php
protected $policies = [
    \App\Models\Document::class => \App\Policies\DocumentPolicy::class,
];
```

## ✅ Step 2: Use Helper Functions to Generate Secure URLs

```php
get_view_media_url($media);      // /media/view/{uuid}
get_download_media_url($media);  // /media/download/{uuid}
get_stream_media_url($media);    // /media/stream/{uuid}
```

> These routes are protected based on your policy logic and login status.
