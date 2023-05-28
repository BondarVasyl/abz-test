<?php

namespace App\Facades;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Facade;

/**
 * @method put($file, $type, $module)
 * @method putAs($file, $type, $module, $filename = null)
 * @method preparePath($root = null)
 * @method touchFolder($path)
 * @method compressPhoto(UploadedFile $file, $path)
 * @method prepareDefaultPath($root = null)
 * @method setRoot(string $root)
 * @method fileUrl(string $string, bool $favicon = false)
 *
 * @see \App\HelperClasses\FileUploader
 */
class FileUploader extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'fileUploader';
    }
}
