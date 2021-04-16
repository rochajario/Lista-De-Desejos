<?php
namespace rochajario\ListaDeDesejos\model;

class Bcrypt
{
    private static $output;
    private static $status;

    public static function encrypt($input)
    {
        $cost = '08';
        $salt = bin2hex(random_bytes(13));
        self::$output = (crypt($input, '$2a$' . $cost . '$' . $salt . '$'));
        return self::$output;
    }
    public static function validate($input, $hash)
    {
        if (crypt($input, $hash) === $hash) :
            self::$status = true;
        else :
            self::$status = false;
        endif;
        return self::$status;
    }
}