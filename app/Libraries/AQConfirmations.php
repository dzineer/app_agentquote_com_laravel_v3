<?php

namespace App\Libraries;

use App\Models\Confirmation;

class AQConfirmations
{
    const TOKEN_STRENGTH = 16;

    public static function generateConfirmationToken():string
    {
        $random_hash_1 = substr(md5(uniqid(rand(), true)), self::TOKEN_STRENGTH, self::TOKEN_STRENGTH); // 16 characters long
        $random_hash_2 = substr(md5(uniqid(rand(), true)), self::TOKEN_STRENGTH, self::TOKEN_STRENGTH); // 16 characters long
        $random_hash_3 = substr(md5(uniqid(rand(), true)), self::TOKEN_STRENGTH, self::TOKEN_STRENGTH); // 16 characters long
        $random_hash_4 = substr(md5(uniqid(rand(), true)), self::TOKEN_STRENGTH, self::TOKEN_STRENGTH); // 16 characters long

        $random_hash = $random_hash_1 . $random_hash_2 . $random_hash_3 . $random_hash_4;

        return $random_hash;
    }

}