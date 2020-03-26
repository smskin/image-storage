<?php


namespace SMSkin\ImageStorage\Services\HttpService;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Contracts\Container\BindingResolutionException;
use stdClass;

interface ServiceInterface
{
    /**
     * @param string $url
     * @return stdClass
     * @throws BindingResolutionException
     * @throws ClientException
     */
    public function get(string $url): string;

    /**
     * @param string $url
     * @param array $formData
     * @return stdClass
     * @throws BindingResolutionException
     * @throws ClientException
     */
    public function post(string $url, array $formData = []): string;

    /**
     * @param string $url
     * @param array $formData
     * @return stdClass
     * @throws BindingResolutionException
     * @throws ClientException
     */
    public function put(string $url, array $formData = []): string;

    /**
     * @param string $url
     * @param array $formData
     * @return stdClass
     * @throws BindingResolutionException
     * @throws ClientException
     */
    public function multipartPost(string $url, array $formData = []): string;

    /**
     * @param string $url
     * @return stdClass
     * @throws BindingResolutionException
     * @throws ClientException
     */
    public function delete(string $url): string;

    /**
     * @param string $apiToken
     * @return self
     */
    public function setApiToken(string $apiToken);
}
