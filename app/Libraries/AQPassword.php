<?php

namespace App\Libraries;

class AQPassword
{
    private const TOKEN_STRENGTH = 16;

    /**
     * @param int $strength
     * @return string
     */
    public static function generate($strength=self::TOKEN_STRENGTH)
    {
        return str_random($strength);
    }
}