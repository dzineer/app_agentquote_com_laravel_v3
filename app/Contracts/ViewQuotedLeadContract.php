<?php

namespace App\Contracts;

/**
 * Class ViewQuotedLeadContract
 * @package App\Contracts
 */
class ViewQuotedLeadContract
{
    public $name;
    public $email;
    public $user;
    public $quote;

    public function __construct($user, $quote)
    {
        $this->user = $user;
        $this->quote = $quote;
    }

    public function toArray() {
        return [
            'user' => $this->user,
            'quote' => $this->quote,
        ];
    }

    /**
     * @return mixed
     */
    public function getQuote()
    {
        return $this->quote;
    }

    /**
     * @param $user
     * @return mixed
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * @param mixed $quote
     */
    public function setQuote($quote): void
    {
        $this->quote = $quote;
    }

}
