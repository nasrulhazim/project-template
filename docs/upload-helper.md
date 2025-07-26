# 📌 Upload Helper

This merge request introduces a new helper-based implementation for uploading files using Spatie Laravel Media Library. The helper simplifies the file upload process while supporting:

* ✅ **Idempotent uploads**: Prevent duplicate files by comparing content hashes.
* ✅ **Automatic disk selection**: No need to specify disk manually; it uses the Media Library configuration.
* ✅ **Support for both local and private S3 disks**.
* ✅ **Snake_case helper name** for Laravel-style consistency.

## 🧰 Changes

* Added `upload_media_file()` helper.
* Utilises Spatie Media Library under the hood.
* Automatically generates a unique file name when needed.
* Appends timestamp to filename if a non-identical file already exists at the same location.

## 📁 Example Usage

```php
$mediaPath = upload_media_file($request->file('avatar'), model: $user, collection: 'avatars');
```

## ⚙️ Configuration Notes

Ensure `config/filesystems.php` and `config/media-library.php` are configured with the correct `disk_name`. Example:

```php
// config/media-library.php
'disk_name' => env('MEDIA_DISK', 's3-private'),

// config/filesystems.php
's3-private' => [
    'driver' => 's3',
    ...
    'visibility' => 'private',
],
```

## 🧪 Tests / Verification

* ✅ File content hash matching tested.
* ✅ Local and S3 (private) uploads verified.
* ✅ Existing file conflict resolution tested with timestamp suffixing.

