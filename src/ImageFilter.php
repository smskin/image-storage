<?php
/**
 * Created by PhpStorm.
 * User: Mikhaylov Sergey Sergeevich ( @smskin )
 * Date: 06.12.2019
 * Time: 19:52
 */

namespace SMSkin\ImageStorage;

use SMSkin\ImageStorage\Exceptions\ValidationException;

class ImageFilter
{
    public static function blur(int $state): string
    {
        if ($state < 0 || $state > 100){
            throw new ValidationException('State can go from 0 to 100 to blur the image');
        }

        return 'Soften=1,'.$state.',0';
    }

    public const BLACK_AND_WHITE = 'bw=0';

    public const INVERT_COLORS = 'Invert=0';
}