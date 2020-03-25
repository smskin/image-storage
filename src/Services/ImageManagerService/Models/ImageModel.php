<?php

namespace SMSkin\ImageStorage\Services\ImageManagerService\Models;

use stdClass;

class ImageModel
{
    /**
     * @var string
     */
    public $uid;

    /**
     * @var string
     */
    public $fileSize;

    /**
     * @var string
     */
    public $originalFileName;

    /**
     * @var string
     */
    public $publicUrl;

    /**
     * @var string
     */
    public $publicUrlHash;

    final public function unSerialize(stdClass $object): ImageModel
    {
        $this->uid = $object->uid;
        $this->fileSize = $object->fileSize;
        $this->originalFileName = $object->originalFileName;
        $this->publicUrl = $object->publicUrl;
        $this->publicUrlHash = $object->publicUrlHash;
        return $this;
    }
}