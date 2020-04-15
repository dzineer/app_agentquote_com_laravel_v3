<?php

namespace DZResellerClub\Orders\EmailAccounts\Requests;

use DZResellerClub\EmailAddress;
use DZResellerClub\Orders\Order;

class CreateRequest
{
    /**
     * Order for the email account to be created against.
     *
     * @var Order
     */
    private $order;

    /**
     * Desired email address for the email account.
     *
     * @var EmailAddress
     */
    private $email;

    /**
     * Password for the email account.
     *
     * @var string
     */
    private $password;

    /**
     * Notifications email for the email account.
     *
     * @var EmailAddress
     */
    private $notificationsEmail;

    /**
     * User's first name for the email account.
     *
     * @var string
     */
    private $firstName;

    /**
     * User's last name for the email account.
     *
     * @var string
     */
    private $lastName;

    /**
     * Country code for the email account.
     *
     * @var string
     */
    private $countryCode;

    /**
     * Language code for the email account.
     *
     * @var string
     */
    private $languageCode;

    /**
     * CreateRequest constructor.
     *
     * @param Order        $order
     * @param EmailAddress $email
     * @param string       $password
     * @param EmailAddress $notificationsEmail
     * @param string       $firstName
     * @param string       $lastName
     * @param string       $countryCode
     * @param string       $languageCode
     */
    public function __construct(
        Order $order,
        EmailAddress $email,
        string $password,
        EmailAddress $notificationsEmail,
        string $firstName,
        string $lastName,
        string $countryCode,
        string $languageCode
    ) {
        $this->order = $order;
        $this->email = $email;
        $this->password = $password;
        $this->notificationsEmail = $notificationsEmail;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->countryCode = $countryCode;
        $this->languageCode = $languageCode;
    }

    /**
     * Get the ID of the order.
     *
     * @return int
     */
    public function orderId(): int
    {
        return $this->order->id();
    }

    /**
     * Gets the desired email address for the email account.
     *
     * @return EmailAddress
     */
    public function email(): EmailAddress
    {
        return $this->email;
    }

    /**
     * Gets the password for the email account.
     *
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }

    /**
     * Gets the notifications email for the email account.
     *
     * @return EmailAddress
     */
    public function notificationEmail(): EmailAddress
    {
        return $this->notificationsEmail;
    }

    /**
     * Gets the user's first name for the email account.
     *
     * @return string
     */
    public function firstName(): string
    {
        return $this->firstName;
    }

    /**
     * Gets the user's last name for the email account.
     *
     * @return string
     */
    public function lastName(): string
    {
        return $this->lastName;
    }

    /**
     * Gets the country code for the email account.
     *
     * @return string
     */
    public function countryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * Gets the language code for the email account.
     *
     * @return string
     */
    public function languageCode(): string
    {
        return $this->languageCode;
    }
}
