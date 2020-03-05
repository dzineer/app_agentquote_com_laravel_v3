<?php

namespace Dzineer\Security;

/**
 * Class DZNonce
 */
class DZNonce {
	/**
	 * @var string
	 */
	private $salt = '3RKDTcxqRY9eeU9jUFNJwscmdckbQZzM';

	/**
	 * @param $salt
	 */
	public function customSalt( $salt ) {
		$this->salt = $salt;
	}

	/**
	 * @param $key
	 * @param $salt
	 * @param $action
	 *
	 * @return string
	 */
	public function generate( $key, $action ) {
		return sha1($key . $this->salt . $action );
	}

	/**
	 * @param $nonce
	 * @param $key
	 * @param $action
	 *
	 * @return bool
	 */
	public function validate( $nonce, $key, $action ) {
		return $this->generate( $key, $this->salt, $action) === $nonce;
	}
}