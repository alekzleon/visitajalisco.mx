<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class PublicUpload
{
    public static function store(UploadedFile $file, string $directory): string
    {
        $directory = trim($directory, '/');
        $targetDirectory = public_path("assets/uploads/{$directory}");

        if (! is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        $extension = $file->getClientOriginalExtension() ?: $file->extension() ?: 'bin';
        $filename = Str::uuid() . '.' . strtolower($extension);

        $file->move($targetDirectory, $filename);

        return "/assets/uploads/{$directory}/{$filename}";
    }

    public static function delete(?string $url): void
    {
        if (! $url || ! str_starts_with($url, '/assets/uploads/')) {
            return;
        }

        $path = public_path(ltrim($url, '/'));

        if (is_file($path)) {
            unlink($path);
        }
    }
}
