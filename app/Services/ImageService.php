<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ImageService
{
    public static function upload(
        UploadedFile $file,
        string       $directory = 'uploads',
        bool         $convertToWebp = true,
        bool         $withThumbnail = true,
        array        $srcsetWidths = [400, 800, 1200]
    ): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename = Str::uuid()->toString();
        $basePath = public_path('uploads/' . $directory);
        $fullPath = "$basePath/$filename";

        if (!file_exists($basePath)) {
            mkdir($basePath, 0755, true);
        }

        if ($convertToWebp && in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
            $webpPath = "$fullPath.webp";

            Image::make($file)->encode('webp', 85)->save($webpPath);

            if ($withThumbnail) {
                $thumbPath = "$basePath/thumbs";
                if (!file_exists($thumbPath)) {
                    mkdir($thumbPath, 0755, true);
                }

                $thumbFull = "$thumbPath/$filename.webp";
                Image::make($file)
                    ->resize(400, null, function ($c) {
                        $c->aspectRatio();
                        $c->upsize();
                    })
                    ->encode('webp', 85)
                    ->save($thumbFull);
            }

            foreach ($srcsetWidths as $width) {
                $variantPath = "$basePath/{$filename}-{$width}.webp";

                Image::make($file)
                    ->resize($width, null, function ($c) {
                        $c->aspectRatio();
                        $c->upsize();
                    })
                    ->encode('webp', 85)
                    ->save($variantPath);
            }

            return "$directory/$filename.webp";
        }

        $file->move($basePath, "$filename.$extension");

        return "$directory/$filename.$extension";
    }
}
