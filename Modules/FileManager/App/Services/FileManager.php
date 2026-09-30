<?php

namespace Modules\FileManager\App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileManager
{
    /**
     * The disk that image uploads are stored on and served from.
     *
     * Uses Cloudinary when it's configured (CLOUDINARY_CLOUD_NAME set in .env)
     * so uploads survive redeploys/restarts on hosts with ephemeral disk
     * storage (e.g. Render). Falls back to the local 'public' disk when
     * Cloudinary isn't configured, so local development keeps working with
     * no setup. This is the single source of truth for which disk is
     * "active" - Image::uri() reads the same value, so uploads and the
     * URLs generated for them always agree on where the file actually is.
     */
    public static function activeDisk(): string
    {
        return filled(config('filesystems.disks.cloudinary.cloud_name')) ? 'cloudinary' : 'public';
    }

    public static function upload(UploadedFile $file, ?string $disk = null): false|string
    {
        return Storage::disk($disk ?? self::activeDisk())->putFileAs(
            self::generateFilePath(),
            $file,
            self::generateFilename($file)
        );
    }

    public static function generateFilePath($prefix = 'images'): string
    {
        return "$prefix/".now()->format('Y/m/d').Str::uuid();
    }

    public static function generateFilename(UploadedFile $file): string
    {
        $filename = $file->getClientOriginalName();
        if (strlen($filename) > 170) {
            $extension = $file->getClientOriginalExtension();
            $basename = substr($filename, 0, 150);

            return $basename.'.'.$extension;
        }

        return $filename;
    }

    public static function uploadFromFile(string $filePath): false|string
    {
        if (! file_exists($filePath)) {
            return false;
        }
        $filename = pathinfo($filePath, PATHINFO_BASENAME);
        $destinationPath = self::generateFilePath();

        return Storage::disk(self::activeDisk())->putFileAs(
            $destinationPath,
            $filePath,
            $filename
        );
    }

    public static function delete(string $filePath): bool
    {
        if (Storage::disk(self::activeDisk())->exists($filePath)) {
            return Storage::disk(self::activeDisk())->delete($filePath);
        }

        return false;
    }

    public static function replaceFile(UploadedFile $newFile, string $filePath): false|string
    {
        $filePathWithoutName = pathinfo($filePath, PATHINFO_DIRNAME);
        $fileBaseName = pathinfo($filePath, PATHINFO_BASENAME);

        return Storage::disk(self::activeDisk())->putFileAs(
            $filePathWithoutName,
            $newFile,
            $fileBaseName
        );
    }

    public static function getReadableSize(?int $size): string
    {
        if (is_null($size)) {
            return __('unknown');
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $base = 1024;
        $i = floor(log($size, $base));
        $readableSize = round($size / ($base ** $i), 2);

        return $readableSize.' '.$units[$i];
    }
}
