<?php
/**
 * Created by PhpStorm.
 * User: Mikhaylov Sergey Sergeevich ( @smskin )
 * Date: 06.12.2019
 * Time: 14:03
 */

namespace SMSkin\ImageStorage\Models;

class ImageModel
{
    public $userUid;
    public $projectUid;
    public $uid;
    public $fileExt;
    public $fileHash;
    public $fileSize;
    public $originalFileName;
    public $localFileName;
    public $publicUrl;
    public $publicUrlHash;

    final public function unserialize(\stdClass $object): ImageModel
    {
        $this->userUid = $object->user_uid;
        $this->projectUid = $object->project_uid;
        $this->uid = $object->uid;
        $this->fileExt = $object->file_ext;
        $this->fileHash = $object->file_hash;
        $this->fileSize = $object->file_size;
        $this->originalFileName = $object->original_file_name;
        $this->localFileName = $object->local_file_name;
        $this->publicUrl = $object->public_url;
        $this->publicUrlHash = $object->public_url_hash;
        return $this;
    }
}