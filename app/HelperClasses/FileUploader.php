<?php

declare(strict_types=1);

namespace App\HelperClasses;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File as GlobalFile;
use Tinify\Tinify;

class FileUploader
{
    protected $root = 'uploads';

    public function setRoot(string $root)
    {
        $this->root = $root;
    }

    public function put($file, $type, $module)
    {
        $path = $this->preparePath($this->root . '/' . $type . '/' . $module);

        return Storage::putFile($path, new File($file->getPathname()));
    }

    public function putAs($file, $type, $module, $filename = null)
    {
        $path = $this->preparePath($this->root . '/' . $type . '/' . $module);

        return Storage::putFileAs($path, new File($file->getPathname()), $filename . '.' . $file->getClientOriginalExtension());
    }

    public function preparePath($root = null)
    {
        $name = Str::lower(Str::random(32));

        $root = empty($root) ? $this->root : $root;

        return $this->generateUniquePath($name, $root);
    }

    public static function prepareDefaultPath($root = null): string
    {
        $name = Str::lower(Str::random(32));

        return self::generateUniquePath($name, $root ?? 'uploads');
    }

    public function touchFolder($path)
    {
        if (!file_exists($path)) {
            GlobalFile::makeDirectory($path, $mode = 0777, true, true);
        }
    }

    public function compressPhoto(UploadedFile $file, $path): string
    {
        Tinify::setKey(config('tinify.key'));

        $source = \Tinify\fromFile(storage_path('app/public/' . $path));

        $preparedPath = self::prepareDefaultPath('uploads/image/compressed');

        $storageFilePath = $preparedPath . '/' . $file->getClientOriginalName();

        $compressedFilePath = storage_path('app/public/' . $preparedPath . '/');

        FileUploader::touchFolder($compressedFilePath);

        $source->toFile($compressedFilePath . $file->getClientOriginalName());

        return $storageFilePath;
    }

    public static function fileUrl($string, $favicon = false): ?string
    {
        if ($favicon) {
            return config('app.url') . '/' . str_replace('public', '', $string);
        }

        if ($string) {
            if (!str_contains($string, 'http')) {
                return str_contains($string, 'storage/') ? asset($string) : asset('storage/'.$string);
            }

            return $string;
        }

        return null;
    }
    private static function generateUniquePath($name, $root): string
    {
        $a = substr($name, 0, 2);
        $b = substr($name, 2, 2);

        return $root . '/' . $a . '/' . $b;
    }
}
