<?php


namespace Libraries\Utilities;


public

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
