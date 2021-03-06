<?php

namespace Jobs\ServiceBundle\Models;

class ErrorCode
{
    private static $codes = array();

    public static function codes()
    {
        $errorCodes = array();
        //Registration and login Page
        $errorCodes[1001] = 'Invalid Email';
        $errorCodes[1002] = 'Invalid Password';
        $errorCodes[1003] = 'Password does not match with confirm password';
        $errorCodes[1004] = 'Email already in database.';
        $errorCodes[1005] = 'User does not exists in our database.';
        $errorCodes[1010] = 'Missing Id.';
        $errorCodes[1011] = 'Invalid Id.';
        return $errorCodes;
    }

    public static function getError($code)
    {
        if (empty(self::$codes)) {
            self::$codes = self::codes();
        }
        if (!isset(self::$codes[$code])) return '';
        return self::$codes[$code];
    }
}