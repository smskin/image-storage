<?php

namespace SMSkin\ImageStorage\Services\ImageManagerService;

use GuzzleHttp\Exception\ClientException;
use SMSkin\ImageStorage\Services\ImageManagerService\Exceptions\ConfigException;
use SMSkin\ImageStorage\Services\ImageManagerService\Exceptions\FileNotFoundException;
use SMSkin\ImageStorage\Services\ImageManagerService\Models\ImageModel;

interface ServiceInterface
{
    /**
     * @param string $path
     * @param string|null $filename
     * @return ImageModel
     * @throws FileNotFoundException
     * @throws ClientException
     * @throws ConfigException
     */
    public function upload(string $path, string $filename = null): ImageModel;

    /**
     * @param string $publicUrl
     * @throws ConfigException
     * @throws ClientException
     */
    public function delete(string $publicUrl): void;
}