<?php

namespace App\Contracts;

class PendingSMSCodeVerificationContract
{
    public $name;
    public $email;
    public $domain;
    public $otp;

    public function __construct($name, $email, $domain, $otp)
    {
        $this->name = $name;
        $this->email = $email;
        $this->domain = $domain;
        $this->otp = $otp;
    }

    public function toArray() {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'domain' => $this->domain,
            'otp' => $this->otp
        ];
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getOtp()
    {
        return $this->otp;
    }

    /**
     * @param $otp
     */
    public function setOtp($otp): void
    {
        $this->otp = $otp;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param $domain
     */
    public function setDomain($domain): void
    {
        $this->domain = $domain;
    }

}
