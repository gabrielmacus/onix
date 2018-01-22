<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 20/01/2018
 * Time: 20:48
 */

namespace framework\modules\base\exception;


class ValidationException extends \Exception
{
    public function __construct($message = "")
    {
        parent::__construct($message, 400);
    }


}