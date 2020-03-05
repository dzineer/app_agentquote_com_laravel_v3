<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-03-05
 * Time: 17:09
 */

namespace App\Subscriptions;


class AQMeetingSubscription extends ZohoSubscriptions {

	private $email;
	private $password;

	public function __construct($data) {
		parent::__construct($data);
	}

	/**
	 * @param $event
	 * @param $post_data
	 */
	public function subscribe(): void {
		$this->setUp();

		$this->email = $this->fields['aqm_u'];
		$this->password = $this->fields['aqm_p'];

		$this->sendTemplateMessage();

		// Email notification
		// That a new user was signed up
		// That they need to setup customer
	}

	protected function sendTemplateMessage() {

	}

}