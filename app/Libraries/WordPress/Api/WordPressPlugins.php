<?php

namespace App\Libraries\WordPress\Api;

use DOMDocument;
use DOMXPath;

class WordPressPlugins {

    private $api;
    private $url;
    private $doc;
    private $xml;
    private $xpath;
    private $plugins = [];
    private $response;

    public function __construct() {
        $this->api = new WordPressAPI();
    }

    public function getPlugins($url) {
        $this->url = $url;
        $this->getContent();
        $this->getPluginsViaLinkTags();
        $this->getPluginsViaScriptTags();
        $this->getPluginsViaComments();
    }

    public function getCommonPluginsInHTMLComments() {
        return [
            sha1('<!-- / Yoast SEO plugin. -->') => "Yoast",
            sha1('<!-- BEGIN recaptcha, injected by plugin wp-recaptcha-integration  -->') => "wp-recaptcha-integration",
        ];
    }

    protected function getContent() {
        $this->response = $this->api->request( 'GET', $this->url, [] );
        libxml_use_internal_errors( true );
        $this->doc      = new DOMDocument();
        @$this->doc->loadHTML($this->response);
        $this->xml = simplexml_import_dom($this->doc); // just to make xpath more simple
      //  $this->xpath            = new DOMXPath( $this->doc );
    }

    protected function getPluginsViaLinkTags(): void {
        $linksOrStyles = $this->xml->xpath( '//*[@rel="stylesheet"]' );
        $outputUrls    = [];
        foreach ( $linksOrStyles as $linkOrStyleSimpleXMLElementObj ) {
            if ( $linkOrStyleSimpleXMLElementObj->xpath( '@href' ) != false ) {
                $outputUrls[] = $linkOrStyleSimpleXMLElementObj['href'] . '';
            } else {
                //get the 'url' value.
                $httpStart    = strpos( $linkOrStyleSimpleXMLElementObj . '', 'http://' );
                $httpEnd      = strpos( $linkOrStyleSimpleXMLElementObj . '', '"', $httpStart );
                $outputUrls[] = substr( $linkOrStyleSimpleXMLElementObj . '', $httpStart, ( $httpEnd - $httpStart ) );
                //NOTE:Use preg_match only to get URL. i had to use strpos here
                //since codepad.org doesnt suport preg
                /*
                preg_match(
                    "#((http|https|ftp)://(\S*?\.\S*?))(\s|\;|\)|\]|\[|\{|\}|,|\"|'|:|\<|$|\.\s)#ie",
                    ' ' . $linkOrStyleSimpleXMLElementObj,
                    $matches
                );
                print_r($matches);
                $outputUrls[] = $matches[0];
                */
            }
        }
        echo "\nOutput URLS: " . print_r( $outputUrls, true ) . "\n";
        foreach ( $outputUrls as $url ) {
            $start = stripos( $url, "/plugins/" );
            if ( $start ) {
                echo "\nStart: " . $start . "\n";
                $restOfString    = substr( $url, $start + strlen( "/plugins/" ) );
                $endPoint        = stripos( $restOfString, "/" );
                $this->plugins[] = substr( $restOfString, 0, $endPoint );
                echo "\nRest of String: " . $restOfString . "\n";
            }
        }
        echo "Plugins: " . print_r( $this->plugins, true ) . "\n";
    }


    protected function getPluginsViaComments() {
        $outputUrls    = [];
        $comments = [];
        $rcomments = [];
        $commentsKeysToFind = array_keys( $this->getCommonPluginsInHTMLComments() );
        $commentsToFind = $this->getCommonPluginsInHTMLComments();
        echo "\nComments to find: " . print_r($this->getCommonPluginsInHTMLComments(), true) . "\n";
        if (preg_match_all('#<\!--(.*?)-->#is', $this->response, $rcomments)) {

            echo "\nrcomments: " .  print_r($rcomments, true) . "\n";

            foreach ($rcomments[0] as $c) {
                echo "\nc: " . $c . "\n";
                $key = sha1($c);
                if (in_array($key, $commentsKeysToFind)) {
                    echo "\nKey: " . $key . "\n";
                    $plugin = $commentsToFind[ $key ];
                    if (! in_array($plugin, $this->plugins)) {
                        $this->plugins[] = $plugin;
                    }
                }
                $comments[] = $c;
            }

        } else {
            // No comments matches
            return null;
        }
        echo "\nComments" . print_r($comments, true) . "\n";
        echo "Plugins: " . print_r( $this->plugins, true ) . "\n";
    }
/*
sha1('google-mp3-audio-player') => 'google-mp3-audio-player',
sha1('wp-ecommerce-shop-styling') => 'wp-ecommerce-shop-styling' ,
sha1('google-picasa-albums-viewer') => 'google-picasa-albums-viewer'  ,
sha1('tinymce-thumbnail-gallery) => 'tinymce-thumbnail-gallery' ,
sha1('dukapress') => 'dukapress'  ,
sha1('search'history-collection') => 'search'history-collection' ,
sha1('paypal-currency-converter-basic-for-woocommerce') => 'paypal-currency-converter-basic-for-woocommerce',
sha1('search'really-simple-guest-post') => 'search'really-simple-guest-post' ,
sha1('wp-swimteam') => 'wp-swimteam',
sha1('search'simple-download-button-shortcode') => 'search'simple-download-button-shortcode'  ,
sha1('sell-downloads') => 'sell-downloads',
sha1('thecartpress') => 'thecartpress'  ,
sha1('advanced-uploader') => 'advanced-uploader',
sha1('brandfolder') => 'brandfolder',
sha1('formcraft-form-builder') => 'formcraft-form-builder' ,
sha1('search'simple-ads-manager') => 'search'simple-ads-manager' ,
sha1('reflex-gallery') => 'reflex-gallery',
sha1('acf-frontend-display-by-catsplugins') => 'acf-frontend-display-by-catsplugins',
sha1('work-the-flow-file-upload') => 'work-the-flow-file-upload' ,
sha1('impress-agents') => 'impress-agents',
 */
    private function getUnwantedPlugins() {

        $unwantedPlugins = [
            sha1('wp-super-cache') => ['name' => 'wp-super-cache', 'weight' => 1],
            sha1('w3-total-cache') => ['w3-total-cache', 'weight' => 1 ],
            sha1('jetpack') => ['jetpack', 'weight' => 1 ],
            sha1('all-in-one-seo-pack') => ['all-in-one-seo-pack', 'weight' => 1 ],
            sha1('wordfence') => ['wordfence', 'weight' => 1 ],
            sha1('contact-form-7') => ['contact-form-7', 'weight' => 1 ],
            sha1('nextgen-gallery') => ['nextgen-gallery', 'weight' => 1 ],
            sha1('redirection') => ['redirection', 'weight' => 1 ],
            sha1('wordpress-seo') => ['wordpress-seo', 'weight' => 1 ],
            sha1('woocommerce') => ['woocommerce', 'weight' => 1 ],
            sha1('backupwordpress') => ['backupwordpress', 'weight' => 1 ],
            sha1('wp-symposium-pro') => ['wp-symposium-pro', 'weight' => 1 ],
            sha1('wp-ecommerce-shop-styling') => ['wp-ecommerce-shop-styling', 'weight' => 1 ],
            sha1('google-picasa-albums-viewer') => ['google-picasa-albums-viewer', 'weight' => 1 ],
            sha1('tinymce-thumbnail-gallery') => ['tinymce-thumbnail-gallery', 'weight' => 1 ],
            sha1('dukapress') => ['dukapress', 'weight' => 1 ],
            sha1('paypal-currency-converter-basic-for-woocommerce') => ['paypal-currency-converter-basic-for-woocommerce', 'weight' => 1 ],
            sha1('wp-swimteam') => ['wp-swimteam', 'weight' => 1 ],
            sha1('sell-downloads') => ['sell-downloads', 'weight' => 1 ],
            sha1('thecartpress') => ['thecartpress', 'weight' => 1 ],
            sha1('advanced-uploader') => ['advanced-uploader', 'weight' => 1 ],
            sha1('brandfolder') => ['brandfolder', 'weight' => 1 ],
            sha1('formcraft-form-builder') => ['formcraft-form-builder', 'weight' => 1 ],
            sha1('reflex-gallery') => ['reflex-gallery', 'weight' => 1 ],
            sha1('acf-frontend-display-by-catsplugins') => ['acf-frontend-display-by-catsplugins', 'weight' => 1 ],
            sha1('work-the-flow-file-upload') => ['work-the-flow-file-upload', 'weight' => 1 ],
            sha1('impress-agents') => ['impress-agents', 'weight' => 1 ],
            sha1('google-mp3-audio-player') => ['google-mp3-audio-player', 'weight' => 1 ],
            sha1('impress-agents') => ['impress-agents', 'weight' => 1 ],
            sha1('simple-ads-manager') => ['simple-ads-manager', 'weight' => 1 ],
            sha1('impress-agents') => ['impress-agents', 'weight' => 1 ],
            sha1('history-collection') => ['history-collection', 'weight' => 1 ],
            sha1('really-simple-guest-post') => ['really-simple-guest-post', 'weight' => 1, 'override_weight' => 30 ],
            sha1('simple-download-button-shortcode') => ['simple-download-button-shortcode', 'weight' => 1 ],
        ];

        foreach($unwantedPlugins as $key => $value) {
            if( isset($unwantedPlugins['override_weight']) ) {
                $unwantedPlugins[ $key ]['weight'] = $unwantedPlugins['override_weight'];
            } else {
                $unwantedPlugins[ $key ]['weight'] =  10;
            }
        }

       return $unwantedPlugins;
    }

    protected function getPluginsViaScriptTags(): void {
        $scripts = $this->xml->xpath( '//script[@type="text/javascript"]' );
        $outputUrls    = [];
        foreach ( $scripts as $scriptSimpleXMLElementObj ) {
            if ( $scriptSimpleXMLElementObj->xpath( '@src' ) != false ) {
                $outputUrls[] = $scriptSimpleXMLElementObj['src'] . '';
            } else {
                //get the 'url' value.
                $httpStart    = strpos( $scriptSimpleXMLElementObj . '', 'http://' );
                $httpEnd      = strpos( $scriptSimpleXMLElementObj . '', '"', $httpStart );
                $outputUrls[] = substr( $scriptSimpleXMLElementObj . '', $httpStart, ( $httpEnd - $httpStart ) );
            }
        }
        echo "\nOutput URLS: " . print_r( $outputUrls, true ) . "\n";
        foreach ( $outputUrls as $url ) {
            $start = stripos( $url, "/plugins/" );
            if ( $start ) {
                echo "\nStart: " . $start . "\n";
                $restOfString    = substr( $url, $start + strlen( "/plugins/" ) );
                $endPoint        = stripos( $restOfString, "/" );
                $plugin = substr( $restOfString, 0, $endPoint );
                if (! in_array($plugin, $this->plugins)) {
                    $this->plugins[] = $plugin;
                }
                echo "\nRest of String: " . $restOfString . "\n";
            }
        }
        echo "Plugins: " . print_r( $this->plugins, true ) . "\n";
    }
}
