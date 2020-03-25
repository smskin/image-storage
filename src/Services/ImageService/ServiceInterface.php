<?php

namespace SMSkin\ImageStorage\Services\ImageService;

use SMSkin\ImageStorage\Services\ImageService\Models\ImageModel;

interface ServiceInterface
{
    public function make(string $url, string $format = null, int $quality = null): ImageModel;
}