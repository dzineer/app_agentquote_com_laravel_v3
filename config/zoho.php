<?php

return [
	'apis' => [
		'current_version' => '1',
		'1' => [
			'subscriptions' => [
				'subscriptions' => 'https://subscriptions.zoho.com/api/v1/subscriptions',
				'new' => [
					'hostedpages' => 'https://subscriptions.zoho.com/api/v1/hostedpages/newsubscription'
				],
				'hostedpages' => 'https://subscriptions.zoho.com/api/v1/hostedpages',
				'customers' => 'https://subscriptions.zoho.com/api/v1/customers',
				'coupons' => 'https://subscriptions.zoho.com/api/v1/coupons/'
			]
		]
	],
	'modules' => [
		'subscriptions'
	],
	'products' => [
		'my_mobile_life_quoter',
		'microsite',
		'aqmeeting',
		'aqmeeting',
        'affiliate_program_complete',
	],
	'plans' => [
		'EC8C812CECA579F2F722C9626B073E8462B8777D' => 'my_mobile_life_quoter',
		'6B5CDF4073B8166E5CC01A2532469D2E356EEBFD' => 'aq2e_microsite',
		'6652DD8A2EEC432429A0A6E782015D630FED1E04' => 'aqmeeting'
	],
	'security' => [
		'security_header' => 'x-zoho-webhook-security-header',
		'public_key' => 'agentquote__public__key__JmAbBpJNzH7jGry6SgyGueuBGFqwa5mesMp2sJ9m',
		'modules' => [
			"subscriptions"
		],
		'headers' => array(
			'X-com-zoho-subscriptions-organizationid' => '677920788',
			'Authorization' => 'Zoho-authtoken 07f4d810dc39a4def0ef247e9d45fd83',
			'Content-Type' => 'application/json;charset=UTF-8'
		)
	],

	'auth' => [
		"accountid" => "834839489",
		"userid" => "agentquote-api",
		"password" => "TVn3DSrb7z67rLre6HjDXjam",
		"token" => "vVbUxqjugFnYns9wRmKndf5k8K28Dj57DutCNZaF"
	],
	"test_customer" => [
		"customer" => [
			"display_name" => "Customer B",
			"first_name" => "Frank",
			"last_name" =>"Delano",
			"email" => "frankdd3@gmail.com"
		],
		"plan" => [
			"plan_code" => "my_mobile_life_quoter"
		]
	],
	"webhooks" => [
		"security" => [
			"headers" => [
				'security_header' => 'x-zoho-webhook-security-header',
				'x-zoho-webhook-public-key' => 'agentquote__public__key__JmAbBpJNzH7jGry6SgyGueuBGFqwa5mesMp2sJ9m',
				'x-zoho-webhook-token' => 'CTDLpkQ5jWBUAVg5Bj4Bp3dmcTCLJRKKPgR9Jmv'
			]
		]
	]
];
