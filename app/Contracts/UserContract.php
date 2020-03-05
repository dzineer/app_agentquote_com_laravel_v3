<?php

namespace App\Contracts;

class UserContract
{
    public $fname;
    public $lname;
    public $email;
    public $confirmationToken;

    public function __construct($fname, $lname, $email, $confirmationToken)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->confirmationToken = $confirmationToken;
    }

    public function toArray() {
        return [
            'email' => $this->email,
            'fname' => $this->fname,
            'lname' => $this->lname,
            'confirmation_token' => $this->confirmationToken
        ];
    }

    /**
     * @return mixed
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * @param mixed $fname
     */
    public function setFname($fname): void
    {
        $this->fname = $fname;
    }

    /**
     * @return mixed
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * @param mixed $lname
     */
    public function setLname($lname): void
    {
        $this->lname = $lname;
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