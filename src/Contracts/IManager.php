<?php
/**
 * Created by PhpStorm.
 * User: Mikhaylov Sergey Sergeevich ( @smskin )
 * Date: 06.12.2019
 * Time: 14:43
 */

namespace SMSkin\ImageStorage\Contracts;

use SMSkin\ImageStorage\Models\ImageModel;

interface Manager
{
    public function upload(string $path, string $filename = null): ImageModel;

    public function delete(string $publicUrl): void;
}