<?php

namespace Jobs\ServiceBundle\Models;

class ErrorCode
{
    public static function codes()
    {
        $errorCodes = array();
        //Registration Page
        $errorCodes[1001] = 'Invalid Email';
        $errorCodes[1002] = 'Invalid Password';
        $errorCodes[1003] = 'Password does not match with confirm password';
        return $errorCodes;
    }

    public static function getError($code)
    {
        $errorCodes = self::codes();
        if (!isset($errorCodes[$code])) return '';
        return $errorCodes[$code];
    }
}