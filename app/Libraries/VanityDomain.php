<?php

namespace App\Libraries;

use App\Facades\AQLog;

class VanityDomain {
    /**
     * @var array
     */
    private $parts;
    /**
     * @var int
     */
    private $length;
    private $domain;
    private $subdomain;

    public function __construct($domain)
    {
        $this->domain = $domain;
    	$this->parts = explode(".", $domain);
    	$this->length = count($this->parts);
    }

    public function length() {
        return $this->length;
    }

    public function belongsTo( $subdomain ) {

        $subdomainParts = explode(".", $subdomain);

        AQLog::info($this->domain);
        AQLog::info($subdomain);
        AQLog::info($this->length + 1);
        AQLog::info($subdomainParts);
        AQLog::info("subdomainParts count: " . count($subdomainParts));
        AQLog::info("length count: " . ($this->length + 1));

        AQLog::info($this->length + 1);

        // do we have a length greater than vanity domain or vanity subdomain?
        if (count($subdomainParts) === $this->length + 1) {

            for($i=0; $i < $this->length; $i++) {

                AQLog::info(
                    $subdomainParts[$i+1] . ' !== ' . $this->parts[$i]
                );

                if ($subdomainParts[$i+1] !== $this->parts[$i]) {
                    return false;
                }
            }

            AQLog::info(
              "Yes it is a subdomain of this domain"
            );

            $this->subdomain = $subdomainParts[0];

            return true;

        }


        return false;

    }

    public function getSubdomain() {
        return $this->subdomain;
    }

}
