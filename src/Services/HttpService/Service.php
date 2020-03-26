<?php

namespace SMSkin\ImageStorage\Services\HttpService;

use SMSkin\ImageStorage\Services\HttpService\Exceptions\HttpException;
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
     * @throws HttpException
     */
    public function get(string $url): string
    {
        $request = $this->getClient()->get(
            $url,
            [
                'headers' => $this->getHeaders()
            ]
        );
        $response = $request->getBody()->getContents();
        if ($request->getStatusCode() !== 200){
            throw new HttpException('Http exception. '.$request->getStatusCode().'. '.$response, $request->getStatusCode());
        }
        return $response;
    }

    /**
     * @param string $url
     * @param array $formData
     * @return stdClass
     * @throws HttpException
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
        $response = $request->getBody()->getContents();
        if ($request->getStatusCode() !== 200){
            throw new HttpException('Http exception. '.$request->getStatusCode().'. '.$response, $request->getStatusCode());
        }
        return $response;
    }

    /**
     * @param string $url
     * @param array $formData
     * @return stdClass
     * @throws HttpException
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
        $response = $request->getBody()->getContents();
        if ($request->getStatusCode() !== 200){
            throw new HttpException('Http exception. '.$request->getStatusCode().'. '.$response, $request->getStatusCode());
        }
        return $response;
    }

    /**
     * @param string $url
     * @param array $formData
     * @return stdClass
     * @throws HttpException
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
        $response = $request->getBody()->getContents();
        if ($request->getStatusCode() !== 200){
            throw new HttpException('Http exception. '.$request->getStatusCode().'. '.$response, $request->getStatusCode());
        }
        return $response;
    }

    /**
     * @param string $url
     * @return stdClass
     * @throws HttpException
     */
    public function delete(string $url): string
    {
        $request = $this->getClient()->delete(
            $url,
            [
                'headers' => $this->getHeaders()
            ]
        );
        $response = $request->getBody()->getContents();
        if ($request->getStatusCode() !== 200){
            throw new HttpException('Http exception. '.$request->getStatusCode().'. '.$response, $request->getStatusCode());
        }
        return $response;
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

    private function getClient(): Client
    {
        /** @noinspection PhpUndefinedFunctionInspection */
        return app()->make(Client::class);
    }
}
