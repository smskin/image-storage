<?php

namespace SMSkin\ImageStorage\Services\ImageManagerService;

use SMSkin\ImageStorage\Services\HttpService\Exceptions\HttpException;
use SMSkin\ImageStorage\Services\ImageManagerService\Exceptions\ConfigException;
use SMSkin\ImageStorage\Services\ImageManagerService\Exceptions\FileNotFoundException;
use SMSkin\ImageStorage\Services\ImageManagerService\Models\ImageModel;
use SMSkin\ImageStorage\Services\HttpService\Service as HttpService;

class Service implements ServiceInterface
{
    protected $host = 'https://api.image-storage.ru';

    /**
     * @param string $path
     * @param string|null $filename
     * @return ImageModel
     * @throws FileNotFoundException
     * @throws HttpException
     * @throws ConfigException
     */
    public function upload(string $path, string $filename = null): ImageModel
    {
        if (!file_exists($path)){
            throw new FileNotFoundException();
        }

        if (!$filename){
            $filename = $this->getFileName($path);
        }

        $response = $this->getHttpService()
            ->setApiToken($this->getApiToken())
            ->multipartPost(
                $this->host.'/images',
                [
                    [
                        'name'     => 'file',
                        'contents' => file_get_contents($path),
                        'filename' => $filename
                    ]
                ]
            );

        $obj = json_decode($response);
        return (new ImageModel())->unSerialize($obj);
    }

    /**
     * @param string $publicUrl
     * @throws ConfigException
     * @throws HttpException
     */
    public function delete(string $publicUrl): void
    {
        $publicUrlHash = sha1($publicUrl);
        $this->getHttpService()
            ->setApiToken($this->getApiToken())
            ->delete(
                $this->host.'/images/'.$publicUrlHash
            );
    }

    /**
     * @return string
     * @throws ConfigException
     */
    private function getApiToken(): string
    {
        /** @noinspection PhpUndefinedFunctionInspection */
        $token = config('image-storage.api_token',null);
        if (!$token){
            throw new ConfigException('User api token not defined');
        }
        return $token;
    }

    private function getHttpService(): HttpService
    {
        /** @noinspection PhpUndefinedFunctionInspection */
        return app()->make(HttpService::class);
    }

    private function getFileName(string $path): string
    {
        $parts = explode('/',$path);
        return array_pop($parts);
    }
}