<?php

namespace App\Libraries\WordPress\Api;

use DOMDocument;
use DOMXPath;

class WordPressVersion {
    private $api;
    /**
     * @var bool|string
     */
    private $version;
    private $_latestVersion;
    private $versionFound = false;
    private $linkTCheckLatestWordPressVersion = 'http://api.wordpress.org/core/version-check/1.7/';
    public function __construct() {
        $this->api = new WordPressAPI();
    }

    public function getVersion($url) {
        $this->versionFound = false;

        $this->getLatestVersion();
        echo "\nLatest version: " . $this->_latestVersion . "\n";

        if ( $this->versionFromMetaTag( $url ) ) {
            echo "\nversion: " . $this->version . "\n";
        }
        else if ( $this->versionFromFeed( $url ) ) {
            echo "\nversion: " . $this->version . "\n";
        }
        else {
            echo "\nversion not found \n";
        }

        $outOfDate = false;

        if ($this->_latestVersion !== 'unknown') {
            $outOfDate = $this->_latestVersion > $this->version;
        }

        if ($outOfDate) {
            echo "\nYou're WordPress Version is out-of-date.";
            echo "\nYour WordPress version is " . $this->version . " the latest version of WordPress is " . $this->_latestVersion . "\n\n";
        } else {
            echo "\nYou're WordPress Version is up-to-date.\n\n";
        }

        exit;

        return $version;
    }

    protected function getLatestVersion() {
        $result = file_get_contents($this->linkTCheckLatestWordPressVersion);
        $data = json_decode($result, true);
        $this->_latestVersion = 'unknown';

        if (count($data)) {
            // echo print_r($data,true); exit;
            $this->_latestVersion = $data['offers'][0]['current'];

        }

    }

    /**
     * @param $url
     *
     * @return bool|string
     */
    protected function versionFromMetaTag( $url ) {
        $response = $this->api->request( 'GET', $url, [] );
        $doc      = new DOMDocument();
        libxml_use_internal_errors( true );
        $doc->loadHTML( $response );
        $xpath            = new DOMXPath( $doc );
        $wordpressMetaTag = $xpath->evaluate( 'string(//meta[@name="generator"]/@content)' );

        if ( strlen( $wordpressMetaTag ) ) {
            $this->version = explode( " ", $wordpressMetaTag )[1];
            $this->versionFound = true;
        }
        return $this->versionFound;
    }

    protected function versionFromFeed( $url ) {

        $getURL = substr($url, -1) === '/' ?
            $url . "feed" :
            $url . "/feed";

        echo "\nURL: " . $getURL . "\n";

        $rss      = new DOMDocument();
        libxml_use_internal_errors( true );
        $rss->load( $getURL );

        $generator = $rss->getElementsByTagName('generator')->item(0)->nodeValue;

        $this->version = explode("=", $generator)[1];

        if (strlen($this->version)) {
            $this->versionFound = true;
        }

        return $this->versionFound;
    }
}
