<?php
/**
 * Created by PhpStorm.
 * User: Mikhaylov Sergey Sergeevich ( @smskin )
 * Date: 06.12.2019
 * Time: 14:07
 */

use SMSkin\ImageStorage\Services\ImageService\Models\ImageModel;

return [
    'api_token'=>env('IMAGE_STORAGE_API_TOKEN',''),
    'output'=>[
        'image'=>[
            'format'=>ImageModel::FORMAT_JPG,
            'quality'=>90
        ]
    ]
];