<?php


namespace App\Libraries\Utilities;

/**
 * Class TokenGenerator
 * @package Libraries\Utilities
 */
class TokenGenerator
{
    /**
     * @param int $len
     * @return string
     * @throws \Exception
     */
    public static function generate($len = 64) {
        return bin2hex(random_bytes($len));
    }

}
