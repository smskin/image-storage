<?php
/**
 * Created by PhpStorm.
 * User: Mikhaylov Sergey Sergeevich ( @smskin )
 * Date: 06.12.2019
 * Time: 13:59
 */

use SMSkin\ImageStorage\Services\ImageService\Service as ImageService;

if (!function_exists('ist_image')){
    function ist_image($url, string $format = null, int $quality = null){
        /** @noinspection PhpUndefinedFunctionInspection */
        $service = app()->make(ImageService::class);
        /** @noinspection PhpUndefinedMethodInspection */
        return $service->make($url, $format, $quality);
    }
}