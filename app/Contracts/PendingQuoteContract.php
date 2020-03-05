<?php

namespace App\Contracts;

class PendingQuoteContract
{
    public $name;
    public $email;
    public $domain;
    public $confirmationToken;

    public function __construct($name, $email, $domain, $confirmationToken)
    {
        $this->name = $name;
        $this->email = $email;
        $this->domain = $domain;
        $this->confirmationToken = $confirmationToken;
    }

    public function toArray() {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'domain' => $this->domain,
            'confirmation_token' => $this->confirmationToken
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
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed $email
     */
    public function setDomain($domain): void
    {
        $this->domain = $domain;
    }

    /**
     * @return mixed
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * @param mixed $confirmationToken
     */
    public function setConfirmationToken($confirmationToken): void
    {
        $this->confirmationToken = $confirmationToken;
    }


}
