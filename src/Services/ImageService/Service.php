<?php

namespace SMSkin\ImageStorage\Services\ImageService;

use SMSkin\ImageStorage\Services\ImageService\Models\ImageModel;

class Service implements ServiceInterface
{
    public function make(string $url, string $format = null, int $quality = null): ImageModel
    {
        if (!$format){
            /** @noinspection PhpUndefinedFunctionInspection */
            $format = config('image-storage.output.image.format', ImageModel::FORMAT_JPG);
        }
        if (!$quality){
            /** @noinspection PhpUndefinedFunctionInspection */
            $quality = config('image-storage.output.image.quality', 90);
        }

        return new ImageModel(
            $url,
            $format,
            $quality
        );
    }
}