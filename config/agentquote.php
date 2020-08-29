<?php

return [
    'company' => [
        'name' => 'Agent Quote Inc.',
        'legal' => [
            'name' => 'Agent Quote Inc',
            'copyright' => 'Copyright © Agent Quote Inc, All rights reserved.'
        ],
        'domain' => [
            'scheme' => get_ip() === '127.0.0.1' ? 'http' : 'https' ,
            'urls' => [
                'non_secure' => 'http://app.staging.agentquote.com',
                'secure' => 'https://app.staging.agentquote.com',
            ],
            'name' => 'AgentQuote.com',
        ],
        'contact' => [
            'support' => 'support@agentquote.com'
        ],
    ],
    "notifications" => [
        "icon" => '/images/aq-notifications-icon.png'
    ],
	'modules' => [
		'subscriptions'
	],
    "whmcs_api" => [
        "token" => "BD9AFD1F5B993E63FE2DAEE58E66C",
        "username" => "quotedirect_api"
    ],
	'store' => [
		'api' => [
			'jverify' => 'https://store.agentquote.com/user/jverify'
		]
	],
	'apis' => [
		'EC8C812CECA579F2F722C9626B073E8462B8777D' => 'mobile_quoter',
		'6B5CDF4073B8166E5CC01A2532469D2E356EEBFD' => 'microsite',
		'6652DD8A2EEC432429A0A6E782015D630FED1E04' => 'aqmeeting',
		'D9496B04F01D4759764AF7ABBE968451DFE42BB5' => 'coupons',
		'92B35203FB5FDF6AE11AB4391954839E06E2ED4E' => 'jverify',
		'66A1E6CD0CCA175639C4933CDDFE74E20F30861F' => 'check_availability',
        '44CBBD68D0040C4FB1B365835A08FBF09D877D6A' => 'affiliate_program_complete'
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
	"webhooks" => [
		"security" => [
			"headers" => [
				'security_header' => 'x-zoho-webhook-security-header',
				'x-zoho-webhook-public-key' => 'agentquote__public__key__JmAbBpJNzH7jGry6SgyGueuBGFqwa5mesMp2sJ9m',
				'x-zoho-webhook-token' => 'CTDLpkQ5jWBUAVg5Bj4Bp3dmcTCLJRKKPgR9Jmv'
			]
		]
	],
    "defaults" => [
      "main" => [
          "domain" => "app2.agentquote.com",
          "vanity_domain" => get_ip() === '127.0.0.1' ? 'base.subdomains.test' : 'app2.agentquote.com'
      ],
      "routes" => [
          "default" => 'login'
      ]
    ],
    "menus" => [
        "super super user" => [
            [
                'text' => 'Dashboard',
                'url'  => 'dashboard',
                'icon' => 'dashboard'
            ],
            [
                'text' => 'Users',
                'url' => 'super/users',
                'icon' => 'users',
            ],

        ],
        "super user" => [
            [
                'text' => 'Dashboard',
                'url'  => 'dashboard',
                'icon' => 'dashboard'
            ],
            [
                'text' => 'Users',
                'icon' => 'users',
                'submenu' => [
                    [
                        'text' => 'Affiliates',
                        'url'  => 'affiliates',
                        'icon' => 'blank'
                    ],
                    [
                        'text' => 'Agents',
                        'url'  => 'agents',
                        'icon' => 'blank'
                    ]
                ],
            ],
            [
                'text' => 'Ad',
                'url'  => 'super/ad',
                'icon' => 'users'
            ],

            [
                'text' => 'Modules',
                'url'  => '/modules',
                'icon' => 'puzzle-piece',
            ],
            [
                'text' => 'WHMCS',
                'icon' => 'users',
                'submenu' => [
                    [
                        'text' => 'Clients',
                        'url'  => 'whmcs/clients',
                        'icon' => 'blank'
                    ],
                    [
                        'text' => 'Products',
                        'url'  => 'whmcs/products',
                        'icon' => 'blank'
                    ],
                ],
            ],
           /* [
                'text' => 'Reports',
                'icon' => 'pie-chart',
                'submenu' => [
                    [
                        'text' => 'Top Carriers',
                        'url'  => 'reports/top_quoted_carriers?top=5',
                        'icon' => 'blank'
                    ],
                    [
                        'text' => 'Recent Quotes',
                        'url'  => 'reports/recent_quotes',
                        'icon' => 'blank'
                    ],
                    [
                        'text' => 'Logins Report',
                        'url'  => 'reports/logins',
                        'icon' => 'blank'
                    ]
                ],
            ]*/
        ],
        "user" => [

                /*        'MAIN NAVIGATION',*/
                [
                    'text' => 'Dashboard',
                    'url'  => 'dashboard',
                    /*            'can'  => 'manage-blog',*/
                    'icon' => 'dashboard'
                ],
                [
                    'text' => 'Support',
                    'url' => '/support',
                    'icon' => 'life-ring'
                ],
                [
                    'text' => 'Messages',
                    'url' => 'messages',
                    'icon' => 'envelope'
                ],
                [
                    'text' => 'Reports',
                    'icon' => 'pie-chart',
                    'submenu' => [
                        [
                            'text' => 'Recent Quotes',
                            'url'  => 'reports/recent_quotes',
                            'icon' => 'blank'
                        ],
                    ],
                ],
                'SETTINGS',
                [
                    'text' => 'General',
                    'url'  => 'account/settings',
                    'icon' => 'cog',

                    'submenu' => [

                        [
                            'text' => 'Password',
                            'url'  => 'account/security',
                            'icon' => 'key',
                        ],
                        [
                            'text' => 'Default State',
                            'url'  => 'profile/settings',
                            'icon' => 'map-marker',
                        ],
                        [
                            'text' => 'Language Settings',
                            'url'  => 'profile/language/settings',
                            'icon' => 'language',
                        ],

                    ]
                ],


                [
                    'text' => 'Companies',
                    'url'  => 'carriers/settings',
                    'icon' => 'building',
                    'submenu' => [
                        [
                            'text' => 'Term Life',
                            'url'  => 'carriers/termlife/settings',
                            'icon' => 'no-icon',
                        ],
                        [
                            'text' => 'SI Term',
                            'url'  => 'carriers/sit/settings',
                            'icon' => 'no-icon',
                        ],
                        [
                            'text' => 'FE/SIWL',
                            'url'  => 'carriers/siwl/settings',
                            'icon' => 'no-icon',
                        ]

                    ]
                ],


                'PRODUCTS',
                [
                    'text' => 'Quoter',
                    'url' => 'user/quote',
                    'icon' => 'calculator'
                ],
                [
                    'text' => 'Landing Page',
                    'url'  => 'landing-page/settings',
                    'icon' => 'newspaper-o',
//                     'submenu' => [
//                        [
//                            'text' => 'General',
//                            'url'  => 'landing-page/settings',
//                            'icon' => 'no-icon',
//                        ],
//                        [
//                            'text' => 'Modules',
//                            'url'  => 'user/modules',
//                            'icon' => 'no-icon'
//                        ],
//                    ]
                ],

        ],

        "affiliate" => [
            [
                'text' => 'Dashboard',
                'url'  => 'dashboard',
                'icon' => 'dashboard'
            ],
            [
                'text' => 'New Message',
                'url' => 'messages/new',
                'icon' => 'envelope'
            ],
            [
                'text' => 'Groups',
                'url'  => 'groups',
                'icon' => 'object-group'
            ],
            [
                'text' => 'Users',
                'icon' => 'users',
                'submenu' => [
                    [
                        'text' => 'Administrators',
                        'url'  => 'admins',
                        'icon' => 'blank'
                    ],
                    [
                        'text' => 'Managers',
                        'url'  => 'managers',
                        'icon' => 'blank'
                    ],
                    [
                        'text' => 'Agents',
                        'url'  => 'agents',
                        'icon' => 'blank'
                    ]
                ],
            ],
            [
                'text' => 'Settings',
                'icon' => 'cog',
                'submenu' => [
                    [
                        'text' => 'Password',
                        'url'  => 'account/security',
                        'icon' => 'blank'
                    ]
                ],
            ],
            [
                'text' => 'Ads',
                'icon' => 'newspaper-o',
                'submenu' => [
                    [
                        'text' => 'Underwritten Term',
                        'url'  => 'ads/underwritten',
                        'icon' => 'blank'
                    ],
                    [
                        'text' => 'SI Term',
                        'url'  => 'ads/sit',
                        'icon' => 'blank'
                    ],
                    [
                        'text' => 'FE',
                        'url'  => 'ads/fe',
                        'icon' => 'blank'
                    ]
                ],
            ],
            [
                'text' => 'Reports',
                'icon' => 'pie-chart',
                'submenu' => [
                    [
                        'text' => 'Recent Quotes',
                        'url'  => 'reports/recent_quotes',
                        'icon' => 'blank'
                    ],
                    [
                        'text' => 'Logins Report',
                        'url'  => 'reports/logins',
                        'icon' => 'blank'
                    ]
                ],
            ],
            [
                'text' => 'Support',
                'url' => '/support',
                'icon' => 'life-ring'
            ],
        ],

        "administrator" => [
            [
                'text' => 'Dashboard',
                'url'  => 'dashboard',
                'icon' => 'dashboard'
            ],
            [
                'text' => 'New Message',
                'url' => 'messages/new',
                'icon' => 'envelope'
            ],
            [
                'text' => 'Groups',
                'url'  => 'groups',
                'icon' => 'object-group'
            ],
            [
                'text' => 'Users',
                'icon' => 'users',
                'submenu' => [
                    [
                        'text' => 'Managers',
                        'url'  => 'managers',
                        'icon' => 'blank'
                    ],
                    [
                        'text' => 'Agents',
                        'url'  => 'agents',
                        'icon' => 'blank'
                    ]
                ],
            ],
            [
                'text' => 'Settings',
                'icon' => 'cog',
                'submenu' => [
                    [
                        'text' => 'Profile',
                        'url'  => 'account/settings',
                        'icon' => 'blank'
                    ],
                    [
                        'text' => 'Password',
                        'url'  => 'account/security',
                        'icon' => 'blank'
                    ]
                ],
            ],
            [
                'text' => 'Support',
                'url' => '/support',
                'icon' => 'life-ring'
            ],
        ],

        "manager" => [
            [
                'text' => 'Dashboard',
                'url'  => 'dashboard',
                'icon' => 'dashboard'
            ],
            [
                'text' => 'New Message',
                'url' => 'messages/new',
                'icon' => 'envelope'
            ],
            [
                'text' => 'Agents',
                'icon' => 'users',
                'url'  => 'agents'
            ],
            [
                'text' => 'Settings',
                'icon' => 'cog',
                'submenu' => [
                    [
                        'text' => 'Password',
                        'url'  => 'account/security',
                        'icon' => 'blank'
                    ]
                ],
            ],
            [
                'text' => 'Support',
                'url' => '/support',
                'icon' => 'life-ring'
            ],
        ],

    ],
    "super" => [
        "lists" => [
            "pagination" => [
                "items" => 10
            ]
        ],
        "reports" => [
            "pagination" => [
                "items" => 10
            ]
        ]
    ],
    "affiliates" => [
        "lists" => [
            "pagination" => [
                "items" => 10
            ]
        ],
        "reports" => [
            "pagination" => [
                "items" => 10
            ]
        ]
    ],
    "agents" => [
        "reports" => [
            "pagination" => [
                "items" => 10
            ]
        ]
    ],
    "server" => [
        "session_timeout" => 60
    ]
];
