<?php

namespace App\Modules\WHMCSModule\Contracts;

class WHMCRequestContract {

    private $username;
    private $password;
    private $endpoint;
    private $scheme;
    private $host;
    private $url;

    /**
     * @return mixed
     */
    public function getUrl() {
        return $this->getScheme() . '://' . $this->getHost() . '/' . $this->getEndpoint();
    }

    public function __construct($username, $password, $endpoint, $scheme, $host)
    {
        $this->username = $username;
        $this->password = $password;
        $this->endpoint = $endpoint;
        $this->scheme = $scheme;
        $this->host = $host;
        $this->url = $host;
    }

    /**
     * @return mixed
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername( $username ): void {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword( $password ): void {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEndpoint() {
        return $this->endpoint;
    }

    /**
     * @param mixed $endpoint
     */
    public function setEndpoint( $endpoint ): void {
        $this->endpoint = $endpoint;
    }

    /**
     * @return mixed
     */
    public function getScheme() {
        return $this->scheme;
    }

    /**
     * @param mixed $scheme
     */
    public function setScheme( $scheme ): void {
        $this->scheme = $scheme;
    }

    /**
     * @return mixed
     */
    public function getHost() {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost( $host ): void {
        $this->host = $host;
    }

    /**
     * @return array
     */
    public function build() {
        return [
          "credentials" => [
            "username" => $this->getUsername(),
            "password" => $this->getPassword(),
          ],
          "host" => $this->getHost(),
          "endpoint" => $this->getEndpoint(),
          "url" => $this->getUrl(),
        ];
    }
}
