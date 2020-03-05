<?php

namespace App\Contracts;

class AffiliateContract
{
    public $fname;
    public $lname;
    public $email;
    public $coupon_code;

    public function __construct($fname, $lname, $email, $coupon_code)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->coupon_code = $coupon_code;
    }

    public function toArray() {
        return [
            'email' => $this->email,
            'fname' => $this->fname,
            'lname' => $this->lname,
            'coupon_code' => $this->coupon_code
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
    public function getCouponCode()
    {
        return $this->coupon_code;
    }

    /**
     * @param $coupon_code
     */
    public function setCouponCode($coupon_code): void
    {
        $this->coupon_code = $coupon_code;
    }


}