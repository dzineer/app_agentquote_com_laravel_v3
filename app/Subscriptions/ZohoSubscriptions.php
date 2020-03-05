<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-03-05
 * Time: 17:11
 */

namespace App\Subscriptions;

/**
 * Class ZohoSubscriptions
 * @package App\Subscriptions
 */
class ZohoSubscriptions extends Subscriptions {

	/**
	 * @var
	 */
	private $data;
	/**
	 * @var
	 */
	protected $subscription;
	/**
	 * @var
	 */
	protected $plan;
	/**
	 * @var
	 */
	protected $customer;
	/**
	 * @var
	 */
	protected $billing;
	/**
	 * @var
	 */
	protected $fields;

	/**
	 * @param $data
	 */

	public function __construct($data) {
		$this->data = $data;
	}

	public function setUp() {
		$this->data         = $this->data['data'];
		$this->getSubscription($this->data);
		$this->getPlan();
		$this->getCustomer();
		$this->getBillingAddress();
		$this->getCustomFields();
	}

	protected function getCorrectState($stateValue) {
		$states = array(
			'AL'=>'Alabama',
			'AK'=>'Alaska',
			'AZ'=>'Arizona',
			'AR'=>'Arkansas',
			'CA'=>'California',
			'CO'=>'Colorado',
			'CT'=>'Connecticut',
			'DE'=>'Delaware',
			'DC'=>'District of Columbia',
			'FL'=>'Florida',
			'GA'=>'Georgia',
			'HI'=>'Hawaii',
			'ID'=>'Idaho',
			'IL'=>'Illinois',
			'IN'=>'Indiana',
			'IA'=>'Iowa',
			'KS'=>'Kansas',
			'KY'=>'Kentucky',
			'LA'=>'Louisiana',
			'ME'=>'Maine',
			'MD'=>'Maryland',
			'MA'=>'Massachusetts',
			'MI'=>'Michigan',
			'MN'=>'Minnesota',
			'MS'=>'Mississippi',
			'MO'=>'Missouri',
			'MT'=>'Montana',
			'NE'=>'Nebraska',
			'NV'=>'Nevada',
			'NH'=>'New Hampshire',
			'NJ'=>'New Jersey',
			'NM'=>'New Mexico',
			'NY'=>'New York',
			'NC'=>'North Carolina',
			'ND'=>'North Dakota',
			'OH'=>'Ohio',
			'OK'=>'Oklahoma',
			'OR'=>'Oregon',
			'PA'=>'Pennsylvania',
			'RI'=>'Rhode Island',
			'SC'=>'South Carolina',
			'SD'=>'South Dakota',
			'TN'=>'Tennessee',
			'TX'=>'Texas',
			'UT'=>'Utah',
			'VT'=>'Vermont',
			'VA'=>'Virginia',
			'WA'=>'Washington',
			'WV'=>'West Virginia',
			'WI'=>'Wisconsin',
			'WY'=>'Wyoming',
		);

		$state_val_len = strlen($stateValue);

		if($state_val_len === 2) {
			return $stateValue;
		}

		foreach($states as $abbr => $name ) {
			if( $name === $stateValue )
				return $abbr;
		}

		return '';
	}

	protected function findFields( $custom_fields, $fields = [] ) {
		$found = [];
		foreach( $fields as $field )
		{
			foreach ($custom_fields as $f) {
				if ($field === $f['label']) {
					$found[ $field ] = $f['value_formatted'];
				}
			}
		}
		return $found;
	}

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	protected function getSubscription($data) {
		$this->subscription = $data['subscription'];
	}

	/**
	 * @return mixed
	 */
	protected function getPlan() {
		$this->plan = $this->subscription['plan'];
	}

	/**
	 * @return mixed
	 */
	protected function getCustomer() {
		$this->customer = $this->subscription['customer'];
	}

	/**
	 * @return mixed
	 */
	protected function getBillingAddress() {
		$this->billing = $this->customer['billing_address'];
	}

	/**
	 * @return mixed
	 */
	protected function getCustomFields() {
		$this->fields = $this->findFields($this->customer['custom_fields'], ['u', 'p']);
	}
}