<?php

namespace App\Api\v2;

use App\Facades\AQLog;
use App\Helpers\AddresHelper;
use App\Libraries\Utilities\TokenGenerator;
use App\Models\Affiliate;
use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use App\Models\Profile;
use App\Models\RoleUser;
use App\Models\Subscription;
use App\Models\TokenUser;
use App\Models\UserDomain;
use App\Models\WhmcsProduct;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductUsersApiFacade
{
    const DEFAULT_AFFILIATE_ID = 1;
    const DEFAULT_USER_TYPE = 5;

    public function assignUserProduct($data) {

        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {
            return response()->json([
                "message" => "Invalid Request",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        $affiliateGroup = null;
        $affiliateGroupUser = null;
        $user = null;

        AQLog::info(json_encode([
            "message" => "Product Id was passed",
            "product_id" => !! $data['whmcs_product_id'] && $data['whmcs_email'] ? "Has required Parameters." : "Does not have required parameters."
        ]));


        AQLog::info(json_encode([
            "message" => "Product Id was passed",
            "product_id" => $data['whmcs_product_id'],
        ]));

        try {

            DB::beginTransaction();

            AQLog::info(json_encode([
                "message" => "Inside request->has",
            ]));

            $email = $data['whmcs_email'];
            $whmcsProductId = $data['whmcs_product_id'];

            $user = User::where(['email' => $email])->first();

            AQLog::info(print_r([
                "message" => "Checking again email: ",
                'email' => $email
            ], true));

            AQLog::info(print_r([
                "message" => "User",
                "data" => $user
            ], true));

            AQLog::info(print_r([
                "message" => "whmcs_ fields",
                "data" => $data
            ], true));

            // must have an active affiliate
            if ($user && $user->affiliate->active === 0) {
                AQLog::info(print_r([
                    "message" => "Affiliate is not active.",
                ], true));

                return response()->json([
                    "message" => "Affiliate is not active.",
                    "success" => false,
                ]);
            }

            // make sure we don't add any product for a disabled user
            if ($user && $user->active === 0) {
                AQLog::info(print_r([
                    "message" => "User is not active.",
                ], true));

                return response()->json([
                    "message" => "User is not active.",
                    "success" => false,
                ]);
            }

            if ( empty($user) // is null
                && isset($data['whmcs_password'])
                && isset($data['whmcs_firstname'])
                && isset($data['whmcs_lastname'])
                && isset($data['whmcs_street'])
                && isset($data['whmcs_city'])
                && isset($data['whmcs_state_abbrev'])
                && isset($data['whmcs_postcode'])
            ) {

                $affiliateGroup = null;

                AQLog::info(print_r([
                    "message" => "User does not exist. Creating...",
                ], true));

                $name = $data['whmcs_firstname'] . ' ' . $data['whmcs_lastname'];

                if (isset($data['whmcs_name'])) {
                    $name = $data['whmcs_name'];
                }

                // Agent Quote Inc Affiliate Default
                $affiliate_id = self::DEFAULT_AFFILIATE_ID;

                // Basic User
                $user_type_id = self::DEFAULT_USER_TYPE;

                if (isset($data['whmcs_affiliate'])) {

                    AQLog::info(print_r([
                        "message" => "Request has affiliate",
                        "data" => $data
                    ], true));

                    $affiliate = Affiliate::where(["name" => $data['whmcs_affiliate']])->first();

                    AQLog::info( print_r([
                        "message" => "Affiliate",
                        "data" => $affiliate
                    ], true) );

                    if ($affiliate) {

                        $affiliate_id = $affiliate->id;

                        AQLog::info(print_r([
                            "message" => "Affiliate Found",
                        ], true));

                        $affiliateGroup = AffiliateGroup::where(["affiliate_id" => $affiliate_id])->first();

                    } else {
                        AQLog::info(print_r([
                            "message" => "Affiliate does not exist.",
                            "affiliate_name" => $data['whmcs_affiliate']
                        ], true));

                        DB::rollBack();

                        return response()->json([
                            "data" => request()->all(),
                            "message" => "Affiliate does not exist.",
                            "success" => false,
                        ]);
                    }
                } else {
                    AQLog::info(print_r([
                        "message" => "Affiliate is required.",
                        "affiliate_name" => $data['whmcs_affiliate']
                    ], true));

                    DB::rollBack();

                    return response()->json([
                        "message" => "Affiliate is required.",
                        "success" => false,
                    ]);
                }

                AQLog::info(print_r([
                    "message" => "Creating user...",
                    // password should already be hashed
                    'password' => Hash::make($data['whmcs_password']),
                    'email' => $data['whmcs_email'],
                    'fname' => $data['whmcs_firstname'],
                    'lname' => $data['whmcs_lastname'],
                    'name' => $name,
                    'affiliate_id' => $affiliate_id,
                    'type_id' => $user_type_id,
                ], true));

                $user = User::create([
                    // password should already be hashed
                    'password' => $data['whmcs_password'],
                    'email' => $data['whmcs_email'],
                    'fname' => $data['whmcs_firstname'],
                    'lname' => $data['whmcs_lastname'],
                    'name' => $name,
                    'affiliate_id' => $affiliate_id,
                    'type_id' => $user_type_id,
                ]);

                AffiliateGroupUser::create([
                    'affiliate_id' => $affiliate_id,
                    'group_id' => $affiliateGroup->id,
                    'user_id' => $user->id
                ]);

                AQLog::info(print_r([
                    // password should already be hashed
                    'message' => "New User"
                ], true));

                $roleUser = RoleUser::create([
                    'role_id' => $user_type_id,
                    'user_id' => $user->id
                ]);

                AQLog::info(print_r([
                    // password should already be hashed
                    'message' => "Role assigned to user",
                    'user' => $roleUser
                ], true));


                if (isset($data['whmcs_company'])) {
                    $company = $data['whmcs_company'];
                } else {
                    $company = $data['whmcs_firstname'] . ' ' . $data['whmcs_lastname'];
                }

                $givenState = AddresHelper::getCorrectState($data['whmcs_state_abbrev']);

                /**
                "whmcs_password" => $clientsDetails['firstname'],
                "whmcs_company" => $clientsDetails['companyname'],
                "whmcs_firstname" => $clientsDetails['lastname'],
                "whmcs_lastname" => $clientsDetails['firstname'],
                "whmcs_street" => $clientsDetails['address1'],
                "whmcs_city" => $clientsDetails['city'],
                "whmcs_state_abbrev" => $clientsDetails['state'],
                "whmcs_postcode" => $clientsDetails['postcode'],
                "whmcs_domain" => $clientsDetails['domain']
                 */

                $profileUser = Profile::create([
                    'user_id' => $user->id,
                    'contact_email' => $user->email,
                    'company' => $company,
                    'contact_addr1' => $data['whmcs_street'],
                    'contact_city' => $data['whmcs_city'],
                    'contact_state' => $givenState,
                    'contact_zip' => $data['whmcs_postcode'],
                ]);

                AQLog::info(print_r([
                    // password should already be hashed
                    'message' => "Profile assigned to user",
                    'profileUser' => $profileUser
                ], true));

                AQLog::info(print_r([
                    "message" => "Domain name added successfully",
                    "data" => $data['whmcs_domain']
                ], true));


            }

            AQLog::info(json_encode([
                "message" => "Got User",
                "data" => $user
            ]));

            $whmcs_product_id = $data['whmcs_product_id'];

            $whmcsProduct = WhmcsProduct::where(["pid" => $whmcs_product_id])->first();

            if ($whmcsProduct->class === "LandingPageUser") {

                if (UserDomain::where([
                    'domain' => $data['whmcs_domain']
                ])->exists()) {
                    AQLog::info(print_r([
                        "message" =>  "Domain name " . $data['whmcs_domain'] . " already exists.",
                    ], true));

                    DB::rollBack();

                    return response()->json([
                        "message" =>  "Domain name " . $data['whmcs_domain'] . " already exists.",
                        "user" => $user,
                        "success" => false,
                    ]);
                }

                $domain = UserDomain::where(["user_id" => $user->id])->first();

                if (UserDomain::where(["user_id" => $user->id])->exists()) {
                    AQLog::info(print_r([
                        "message" =>  "User already has a " . $domain->name . " registered.",
                    ], true));

                    DB::rollBack();

                    return response()->json([
                        "message" =>  "User already has a " . $domain->name . " registered.",
                        "data" => request()->all(),
                        "success" => false,
                    ]);
                }

                AQLog::info(json_encode([
                    "message" => "Adding user domain " . $data['whmcs_domain'],
                ]));

                UserDomain::create([
                    'user_id' => $user->id,
                    'domain' => $data['whmcs_domain']
                ]);
            }

            if ($whmcsProduct) {

                AQLog::info(json_encode([
                    "message" => "Got WHMCS Product",
                    "data" => $whmcsProduct
                ]));

                AQLog::info(json_encode([
                    "message" => "Checking User",
                    "data" => $user
                ]));

                $productId = $whmcsProduct->local_product_id;
                $userSubscription = Subscription::where(["user_id" => $user->id, "product_id" => $whmcsProduct->local_product_id])->first();

                // can have more than one subscription now
                // disable this one by anding false value
                if (false && $userSubscription) {

                    AQLog::info(print_r([
                        "message" => "User already has subscription",
                        "data" => $userSubscription
                    ], true));

                    DB::rollBack();

                    return response()->json([
                        "message" => "User already has product",
                        "data" => request()->all(),
                        "user" => $user,
                        "userSubscription" => $userSubscription,
                        "success" => false,
                    ]);

                } else {
                    $subscription = Subscription::create([
                        "user_id" => $user->id,
                        "product_id" => $productId
                    ]);

                    $class = 'App\\Models\\' . $whmcsProduct->class;

                    $class::create([
                        "user_id" => $user->id
                    ]);



                    AQLog::info(json_encode([
                        "message" => "Adding user to subscription",
                        "data" => $subscription
                    ]));

                    AQLog::info(json_encode([
                        "message" => "Product " . $whmcsProduct->name . " added to " . $user->email . " user.",
                        "mode" => "debug",
                        "ok" => true,
                        "success" => true,
                    ]));

                    $payload = [
                        "message" => "Product " . $whmcsProduct->name . " added to " . $user->email . " user.",
                        "mode" => "debug",
                        "user" => $user,
                        "subscription" => $subscription,
                        "portal_affiliate_id" => $user->affiliate_id,
                        "ok" => true,
                        "success" => true,
                    ];

                    AQLog::info(json_encode([
                        "message" => "Request Params before check for requested whmcs_token_request",
                        "mode" => "debug",
                        "ip" => request()->ip(),
                    ]));

                    if (isset($data["whmcs_token_request"])) {
                        $tokenUser = TokenUser::where([ "user_id" => $user->id])->first();
                        if ($tokenUser) {
                            $payload = array_merge( $payload,
                                [
                                    "portal_user_token" => $tokenUser->token,
                                    "portal_user_id" => $user->id,
                                    "portal_affiliate_id" => $user->affiliate_id,
                                ]);
                        } else {
                            try {

                                $token = TokenGenerator::generate();

                                TokenUser::create([
                                    "user_id" => $user->id,
                                    "token" => $token
                                ]);

                                $payload = array_merge( $payload, [
                                    "portal_user_token" => $token,
                                    "portal_user_id" => $user->id,
                                    "portal_affiliate_id" => $user->affiliate_id,
                                ]);

                            } catch (\Exception $e) {

                                AQLog::info(json_encode([
                                    "message" => "Error generating token",
                                    "mode" => "debug",
                                    "success" => true,
                                ]));

                                DB::rollBack();

                                return response()->json([
                                    "message" => "Error generating token",
                                    "mode" => "debug",
                                    "success" => true,
                                ]);

                            }
                        }
                    }


                    DB::commit();

                    AQLog::info(json_encode($payload));

                    return response()->json($payload);

                }
            } else {

                AQLog::info(json_encode([
                    "message" => "Cannot find product",
                    "mode" => "debug",
                    "success" => true,
                ]));

                DB::rollBack();

                return response()->json([
                    "message" => "Cannot find product",
                    "mode" => "debug",
                    "success" => false
                ]);

            }
        }
        catch (\PDOException $e) {

            AQLog::info(print_r([
                // password should already be hashed
                'message' => "Transaction Failed",
                'user' => $e->getMessage()
            ], true));

            DB::rollBack();
        }

        return response()->json([
            "message" => "Error",
            "mode" => "debug",
            "success" => false
        ]);
    }

    public function removeUserProduct($data) {

        if ($data['token'] !== 'BD9AFD1F5B993E63FE2DAEE58E66C' && $data['username'] !== 'quotedirect_api') {
            return response()->json([
                "message" => "Invalid Request",
                "data" => request()->all(),
                "success" => false,
            ]);
        }


        AQLog::info( json_encode([
            "message" => "Inside request->has",
        ]) );

        $email = $data['whmcs_email'];
        $whmcs = $data['whmcs_userid'];
        $whmcsProductId = $data['whmcs_product_id'];

        $user = User::where(['email' => $email])->first();

        if ($user) {


            AQLog::info( json_encode([
                "message" => "Got User",
                "data" => $user
            ]) );

            if ($user && $user->affiliate->active === 0) {
                AQLog::info(print_r([
                    "message" => "Affiliate is not active.",
                ], true));

                return response()->json([
                    "message" => "Affiliate is not active.",
                    "success" => false,
                ]);
            }

            $whmcs_product_id = $data['whmcs_product_id'];

            $whmcsProduct = WhmcsProduct::where(["pid" => $whmcs_product_id])->first();

            if ($whmcsProduct) {

                AQLog::info( json_encode([
                    "message" => "Got WHMCS Product",
                    "data" => $whmcsProduct
                ]) );

                $productId = $whmcsProduct->local_product_id;

                $userSubscription = Subscription::where(["user_id" => $user->id, "product_id" => $productId])->first();

                if ($userSubscription) {

                    AQLog::info( print_r([
                        "message" => "User has subscription",
                        "data" => $userSubscription
                    ], true) );

                    Subscription::where([
                        "user_id" => $user->id,
                        "product_id" => $productId
                    ])->delete();

                    $class = 'App\\Models\\'.$whmcsProduct->class;

                    AQLog::info( json_encode([
                        "message" => "Removing Product " . $whmcsProduct->name . " from " . $user->email . " user.",
                        "mode" => "debug",
                        "ip" => request()->ip(),
                        "ok" => true,
                        "success" => true,
                    ]) );

                    $class::where([
                        "user_id" => $user->id
                    ])->delete();

                    if ($whmcsProduct->class === "LandingPageUser") {

                        if (UserDomain::where([
                            'user_id' => $user->id
                        ])->exists()) {
                            UserDomain::where([
                                'user_id' => $user->id
                            ])->delete();
                        }
                    }

                    return response()->json([
                        "message" => "Removed Product " . $whmcsProduct->name . " from " . $user->email . " user.",
                        "okay" => true,
                        "success" => true,
                    ]);

                } else {
                    AQLog::info( print_r([
                        "message" => "User does not have product",
                    ], true) );

                    return response()->json([
                        "message" => "User does not have product",
                        "data" => request()->all(),
                        "user" => $user,
                        "success" => false,
                    ]);

                }
            } else {
                return response()->json([
                    "message" => "Cannot find product",
                    "data" => request()->all(),
                    "user" => $user,
                    "success" => false,
                ]);
            }

        } else {

            AQLog::info( json_encode([
                "message" => "Invalid user",
                "success" => false,
            ]) );

            return response()->json([
                "message" => "Invalid user",
                "data" => request()->all(),
                "success" => false,
            ]);

        }

/*        AQLog::info( json_encode([
            "message" => "Error",
            "mode" => "debug",
            "success" => false
        ]) );

        return response()->json([
            "message" => "Error",
            "mode" => "debug",
            "ip" => request()->ip(),
            "data" => request()->all(),
            "success" => false
        ]);*/
    }

    public function disableUserProduct($data) {

        if ($data['token'] !== 'BD9AFD1F5B993E63FE2DAEE58E66C' && $data['username'] !== 'quotedirect_api') {
            return response()->json([
                "message" => "Invalid Request",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        AQLog::info( json_encode([
            "message" => "Inside request->has",
        ]) );

        $email = $data['whmcs_email'];
        $whmcs = $data['whmcs_userid'];
        $whmcsProductId = $data['whmcs_product_id'];

        $user = User::where(['email' => $email])->first();

        if ($user) {

            AQLog::info( json_encode([
                "message" => "Got User",
                "data" => $user
            ]) );

            if ($user && $user->affiliate->active === 0) {
                AQLog::info(print_r([
                    "message" => "Affiliate is not active.",
                ], true));

                return response()->json([
                    "message" => "Affiliate is not active.",
                    "success" => false,
                ]);
            }

            $whmcs_product_id = $data['whmcs_product_id'];

            $whmcsProduct = WhmcsProduct::where(["pid" => $whmcs_product_id])->first();

            if ($whmcsProduct) {

                AQLog::info( json_encode([
                    "message" => "Got WHMCS Product",
                    "data" => $whmcsProduct
                ]) );

                $productId = $whmcsProduct->local_product_id;

                $userSubscription = Subscription::where(["user_id" => $user->id, "product_id" => $productId])->first();

                if ($userSubscription) {

                    AQLog::info( print_r([
                        "message" => "User has subscription",
                        "data" => $userSubscription
                    ], true) );

                    Subscription::where([
                        "user_id" => $user->id,
                        "product_id" => $productId
                    ])->update([
                        "active" => 0
                    ]);

                    $class = 'App\\Models\\'.$whmcsProduct->class;

                    AQLog::info( json_encode([
                        "message" => "Disabling Product " . $whmcsProduct->name . " for " . $user->email . " user.",
                        "mode" => "debug",
                        "ok" => true,
                        "success" => true,
                    ]) );

                    $class::where([
                        "user_id" => $user->id
                    ])->update([
                        "active" => 0
                    ]);

                    return response()->json([
                        "message" => "Disabled Product " . $whmcsProduct->name . " for " . $user->email . " user.",
                        "okay" => true,
                        "success" => true,
                    ]);

                } else {
                    AQLog::info( print_r([
                        "message" => "User does not have product",
                    ], true) );

                    return response()->json([
                        "message" => "User does not have product",
                        "data" => request()->all(),
                        "user" => $user,
                        "success" => false,
                    ]);

                }
            } else {
                return response()->json([
                    "message" => "Cannot find product",
                    "data" => request()->all(),
                    "user" => $user,
                    "success" => false,
                ]);
            }

        } else {

            AQLog::info( json_encode([
                "message" => "Invalid user",
                "success" => false,
            ]) );

            return response()->json([
                "message" => "Invalid user",
                "data" => request()->all(),
                "success" => false,
            ]);

        }

/*        AQLog::info( json_encode([
            "message" => "Error",
            "mode" => "debug",
            "success" => false
        ]) );

        return response()->json([
            "message" => "Error",
            "mode" => "debug",
            "ip" => request()->ip(),
            "data" => request()->all(),
            "success" => false
        ]);*/
    }

    public function enableUserProduct($data) {

        if ($data['token'] !== 'BD9AFD1F5B993E63FE2DAEE58E66C' && $data['username'] !== 'quotedirect_api') {
            return response()->json([
                "message" => "Invalid Request",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        AQLog::info( json_encode([
            "message" => "Inside request->has",
        ]) );

        $email = $data['whmcs_email'];
        $whmcs = $data['whmcs_userid'];
        $whmcsProductId = $data['whmcs_product_id'];

        $user = User::where(['email' => $email])->first();

        if ($user) {

            AQLog::info( json_encode([
                "message" => "Got User",
                "data" => $user
            ]) );

            if ($user && $user->affiliate->active === 0) {
                AQLog::info(print_r([
                    "message" => "Affiliate is not active.",
                ], true));

                return response()->json([
                    "message" => "Affiliate is not active.",
                    "success" => false,
                ]);
            }

            $whmcs_product_id = $data['whmcs_product_id'];

            $whmcsProduct = WhmcsProduct::where(["pid" => $whmcs_product_id])->first();

            if ($whmcsProduct) {

                AQLog::info( json_encode([
                    "message" => "Got WHMCS Product",
                    "data" => $whmcsProduct
                ]) );

                $productId = $whmcsProduct->local_product_id;

                $userSubscription = Subscription::where(["user_id" => $user->id, "product_id" => $productId])->first();

                if ($userSubscription) {

                    AQLog::info( print_r([
                        "message" => "User has subscription",
                        "data" => $userSubscription
                    ], true) );

                    Subscription::where([
                        "user_id" => $user->id,
                        "product_id" => $productId
                    ])->update([
                        "active" => 1
                    ]);

                    $class = 'App\\Models\\'.$whmcsProduct->class;

                    AQLog::info( json_encode([
                        "message" => "Disabling Product " . $whmcsProduct->name . " for " . $user->email . " user.",
                        "mode" => "debug",
                        "ok" => true,
                        "success" => true,
                    ]) );

                    $class::where([
                        "user_id" => $user->id
                    ])->update([
                        "active" => 1
                    ]);

                    return response()->json([
                        "message" => "Disabled Product " . $whmcsProduct->name . " for " . $user->email . " user.",
                        "okay" => true,
                        "success" => true,
                    ]);

                } else {
                    AQLog::info( print_r([
                        "message" => "User does not have product",
                    ], true) );

                    return response()->json([
                        "message" => "User does not have product",
                        "data" => request()->all(),
                        "user" => $user,
                        "success" => false,
                    ]);

                }
            } else {
                return response()->json([
                    "message" => "Cannot find product",
                    "data" => request()->all(),
                    "user" => $user,
                    "success" => false,
                ]);
            }

        } else {

            AQLog::info( json_encode([
                "message" => "Invalid user",
                "success" => false,
            ]) );

            return response()->json([
                "message" => "Invalid user",
                "data" => request()->all(),
                "success" => false,
            ]);

        }

/*        AQLog::info( json_encode([
            "message" => "Error",
            "mode" => "debug",
            "success" => false
        ]) );

        return response()->json([
            "message" => "Error",
            "mode" => "debug",
            "ip" => request()->ip(),
            "data" => request()->all(),
            "success" => false
        ]);*/
    }
}
