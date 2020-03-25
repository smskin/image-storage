<?php
/**
 * Created by PhpStorm.
 * User: Mikhaylov Sergey Sergeevich ( @smskin )
 * Date: 06.12.2019
 * Time: 14:02
 */

namespace SMSkin\ImageStorage\Exceptions;

use RuntimeException;
use Throwable;

class FileNotFoundException extends RuntimeException
{
    public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
{
    parent::__construct($message, $code, $previous);
}
}