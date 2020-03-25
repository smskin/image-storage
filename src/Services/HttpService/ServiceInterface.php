<?php


namespace SMSkin\ImageStorage\Services\HttpService;

use SMSkin\ImageStorage\Services\HttpService\Exceptions\HttpException;
use stdClass;

interface ServiceInterface
{
    /**
     * @param string $url
     * @return stdClass
     * @throws HttpException
     */
    public function get(string $url): string;

    /**
     * @param string $url
     * @param array $formData
     * @return stdClass
     * @throws HttpException
     */
    public function post(string $url, array $formData = []): string;

    /**
     * @param string $url
     * @param array $formData
     * @return stdClass
     * @throws HttpException
     */
    public function put(string $url, array $formData = []): string;

    /**
     * @param string $url
     * @param array $formData
     * @return stdClass
     * @throws HttpException
     */
    public function multipartPost(string $url, array $formData = []): string;

    /**
     * @param string $url
     * @return stdClass
     * @throws HttpException
     */
    public function delete(string $url): string;

    /**
     * @param string $accept
     * @return self
     */
    public function setAccept(string $accept);

    /**
     * @param string $apiToken
     * @return self
     */
    public function setApiToken(string $apiToken);
}
