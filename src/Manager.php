<?php
/**
 * Created by PhpStorm.
 * User: Mikhaylov Sergey Sergeevich ( @smskin )
 * Date: 06.12.2019
 * Time: 14:04
 */

namespace SMSkin\ImageStorage;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use SMSkin\ImageStorage\Contracts\Manager as IManager;
use SMSkin\ImageStorage\Exceptions\FileNotFoundException;
use SMSkin\ImageStorage\Models\ImageModel;

class Manager implements IManager
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Manager constructor.
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        if (!$client){
            $client = new Client();
        }
        $this->client = $client;
    }

    /**
     * @param string $path
     * @param string|null $filename
     * @return ImageModel
     */
    final public function upload(string $path, string $filename = null): ImageModel
    {
        if (!file_exists($path)){
            throw new FileNotFoundException();
        }

        if (!$filename){
            $parts = explode('/',$path);
            $filename = array_pop($parts);
        }

        $response = json_decode($this->client->multipartPost(
            '/api/images',
            [
                [
                    'name'     => 'image',
                    'contents' => file_get_contents($path),
                    'filename' => $filename
                ]
            ]
        ));

        return (new ImageModel())->unserialize($response);
    }

    /**
     * @param string $publicUrl
     * @throws RequestException
     * @throws TransferException
     */
    final public function delete(string $publicUrl): void
    {
        $this->client->delete(
            '/api/images/'.sha1($publicUrl)
        );
    }

    /**
     * @param Client $client
     * @return Manager
     */
    final public function setClient(Client $client): Manager
    {
        $this->client = $client;
        return $this;
    }
}