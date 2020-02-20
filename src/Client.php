<?php
/**
 * Created by PhpStorm.
 * User: Mikhaylov Sergey Sergeevich ( @smskin )
 * Date: 06.12.2019
 * Time: 14:03
 */

namespace SMSkin\ImageStorage;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use SMSkin\ImageStorage\Exceptions\ValidationException;

class Client
{
    protected $host = 'https://api.image-storage.ru';

    /**
     * @var string
     */
    protected $userApiToken;

    /**
     * @var string
     */
    protected $projectApiToken;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Client constructor.
     * @throws ValidationException
     */
    public function __construct()
    {
        $this->userApiToken = config('image-storage.client.user_api_token');
        if (!$this->userApiToken){
            throw new ValidationException('User api token not defined');
        }

        $this->projectApiToken = config('image-storage.client.project_api_token');
        if (!$this->userApiToken){
            throw new ValidationException('User api token not defined');
        }

        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * @param string $path
     * @param array $data
     * @return string
     * @throws TransferException
     * @throws RequestException
     */
    final public function multipartPost(string $path, array $data): string
    {
        $data = $this->prepareData($data);

        $request = $this->client->post(
            $this->host.$path,
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$this->userApiToken
                ],
                'multipart' =>  $data
            ]
        );
        return $request->getBody()->getContents();
    }

    /**
     * @param string $path
     * @param array $data
     * @return string
     * @throws TransferException
     * @throws RequestException
     */
    final public function post(string $path, array $data): string
    {
        $data = $this->prepareData($data);

        $request = $this->client->post(
            $this->host.$path,
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$this->userApiToken
                ],
                'form_params' =>  $data
            ]
        );
        return $request->getBody()->getContents();
    }

    /**
     * @param string $path
     * @return string
     * @throws TransferException
     * @throws RequestException
     */
    final public function delete(string $path): string
    {
        $data = $this->prepareData();

        $request = $this->client->delete(
            $this->host.$path,
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$this->userApiToken
                ],
                'form_params'=>$data
            ]
        );
        return $request->getBody()->getContents();
    }

    /**
     * @param string $userApiToken
     * @return Client
     */
    final public function setUserApiToken(string $userApiToken): Client
    {
        $this->userApiToken = $userApiToken;
        return $this;
    }

    /**
     * @param string $projectApiToken
     * @return Client
     */
    final public function setProjectApiToken(string $projectApiToken): Client
    {
        $this->projectApiToken = $projectApiToken;
        return $this;
    }

    /**
     * @return string
     */
    final public function getProjectApiToken(): string
    {
        return $this->projectApiToken;
    }

    private function prepareData(array $data = []): array
    {
        $data[] = [
            'name' => 'project_token',
            'contents' => $this->projectApiToken
        ];
        return $data;
    }
}