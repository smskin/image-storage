<?php
/**
 * Created by PhpStorm.
 * User: Mikhaylov Sergey Sergeevich ( @smskin )
 * Date: 06.12.2019
 * Time: 13:59
 */

use SMSkin\ImageStorage\Image;

if (!function_exists('is_image')){

    /**
     * @param string $url
     * @return Image
     */
    function is_image(string $url): Image
    {
        $image = App::make(SMSkin\ImageStorage\ServiceProvider::SINGLETON_ABSTRACT);
        return $image->setUrl($url);
    }
}