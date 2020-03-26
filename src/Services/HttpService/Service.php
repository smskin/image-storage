<?php

namespace SMSkin\ImageStorage\Services\HttpService;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use stdClass;

class Service implements ServiceInterface
{
    /**
     * @var string
     */
    protected $accept = 'application/json';

    /**
     * @var string
     */
    protected $apiToken;

    /**
     * @param string $url
     * @return stdClass
     * @throws ClientException
     */
    public function get(string $url): string
    {
        $request = $this->getClient()->get(
            $url,
            [
                'headers' => $this->getHeaders()
            ]
        );
        return $request->getBody()->getContents();
    }

    /**
     * @param string $url
     * @param array $formData
     * @return stdClass
     * @throws ClientException
     */
    public function post(string $url, array $formData = []): string
    {
        $request = $this->getClient()->post(
            $url,
            [
                'headers' => $this->getHeaders(),
                'form_params' => $formData
            ]
        );
        return $request->getBody()->getContents();
    }

    /**
     * @param string $url
     * @param array $formData
     * @return stdClass
     * @throws ClientException
     */
    public function put(string $url, array $formData = []): string
    {
        $request = $this->getClient()->put(
            $url,
            [
                'headers' => $this->getHeaders(),
                'form_params' => $formData
            ]
        );
        return $request->getBody()->getContents();
    }

    /**
     * @param string $url
     * @param array $formData
     * @return stdClass
     * @throws ClientException
     */
    public function multipartPost(string $url, array $formData = []): string
    {
        $request = $this->getClient()->post(
            $url,
            [
                'headers' => $this->getHeaders(),
                'multipart' =>  $formData
            ]
        );
        return $request->getBody()->getContents();
    }

    /**
     * @param string $url
     * @return stdClass
     * @throws ClientException
     */
    public function delete(string $url): string
    {
        $request = $this->getClient()->delete(
            $url,
            [
                'headers' => $this->getHeaders()
            ]
        );
        return $request->getBody()->getContents();
    }

    private function getHeaders(): array
    {
        $data = [];
        if ($this->accept){
            $data['Accept'] = $this->accept;
        }
        if ($this->apiToken){
            $data['Authorization'] = 'Bearer '.$this->apiToken;
        }
        return $data;
    }

    public function setAccept(string $accept): Service
    {
        $this->accept = $accept;
        return $this;
    }

    public function setApiToken(string $apiToken): Service
    {
        $this->apiToken = $apiToken;
        return $this;
    }

    /**
     * @return Client
     */
    private function getClient(): Client
    {
        /** @noinspection PhpUndefinedFunctionInspection */
        return app()->make(Client::class);
    }
}
