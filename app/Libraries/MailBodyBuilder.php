<?php

namespace App\Libraries;

/**
 * Class MailBodyBuilder
 *
 * @package App\Libraries
 */
class MailBodyBuilder
{
    /**
     * @param $data
     * @return string
     */
    public static function build($data) {
        $html = '';
        $doc = new \DOMDocument();
        $doc->loadHTML($data);
        $body = $doc->getElementsByTagName('body');

        if ( $body && 0 < $body->length ) {
            $body = $body->item(0);
            $html =$doc->savehtml($body);
        }
        return $html;
    }
}