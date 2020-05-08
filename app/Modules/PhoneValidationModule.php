<?php

namespace App\CustomModules;

use App\Contracts\PendingQuoteContract;
use App\Contracts\PendingSMSCodeVerificationContract;
use App\Contracts\ViewQuoteContract;
use App\Contracts\ViewQuotedLeadContract;
use App\Libraries\QuoteVerification;
use App\Mail\PendingQuoteVerificationEmail;
use App\Mail\PendingSMSOtpVerificationEmail;
use App\Mail\ViewQuoteEmail;
use App\Mail\ViewQuoteLeadCCEmail;
use App\Mail\ViewQuoteLeadEmail;
use App\Models\Line;
use App\Models\Profile;
use App\Models\QuoteUnverified;
use App\Notifications\PhoneVerificationReceived;
use App\User;
use Carbon\Carbon;
use Dzineer\CustomModules\CustomModule;
use Dzineer\CustomModules\Models\CustomModuleAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Dzineer\SMS\Facades\SMS;
use App\Facades\AQLog;
use App\Libraries\SMSErrorDispatch;
use Symfony\Component\VarDumper\VarDumper;

class PhoneValidationModule extends CustomModule {

    const MAX_CHECKED_TIMES = 3;
    private $liveMode = true;
    protected $debug = true;
    /**
     * @var int
     */
    private $timesChecked;
    use QuoteVerification;

    public function install( $module, $data ) {
        // TODO: Ran once to register as a installed admin module

        // dnd($data);

        $userId = Auth::user()->id;

        if (CustomModuleAdmin::where([
            'user_id' => $userId,
            'custom_module_id' => $module->id
        ])->exists()) {
            if ( ! $data['checked'] ) {
                return [ 'successful' => false, 'Module ' . $module->name . ' is already installed. Are you sure you want to overwrite?'];
            }
        }

        CustomModuleAdmin::updateOrCreate(
            [
                'user_id' => $userId,
                'custom_module_id' => $module->id
            ],
            ['data' => $data['config']]
        );

    }

    public function unInstall( $module, $data ) {
        // TODO: remove all installed items

        dd($data);

    }

	public function boot( $module, $data ) {

    }

	public function register() {
        return [ "methods" => $this->getMethods(), "hooks" => $this->getHooks() ];
	}


    /**
     * @param $subject
     * @param int $code
     * @param $quoteUnverified
     * @param string $hash_token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function generateQuoteVerificationRequest(
        $subject,
        int $code,
        $quoteUnverified,
        string $hash_token
    ): \Illuminate\Http\JsonResponse {

        // $this->sendOTPSMS( "Hey Patrick Pegram", $quoteUnverified );
        $responseArray = $this->sendOTPSMS( $code, $quoteUnverified );

        \Illuminate\Support\Facades\Log::info( self::class . "::generateQuoteVerificationRequest - sendOTPSMS - responseArray : " . json_encode([ "responseArray: " => $responseArray]));

        // if our OTP SMS message failed
        if ( isset( $responseArray['errors'] ) ) {
            // since they could not receive OTP via SMS send via email.
            $this->notifyOTPViaEmailNotification( $quoteUnverified );
            // handle our error response
            return SMSErrorDispatch::dispatch(SMSErrorDispatch::SMS_DELIVERY_FAILURE, $quoteUnverified, $hash_token );
        }

        $username = config( 'services.flowroute.access_key' );
        $password = config( 'services.flowroute.secret_key' );

        if (isset($responseArray['data'])) {
            $responseData = $responseArray['data'];
        } else if(isset($responseArray['errors'])) {
            $this->notifyOTPViaEmailNotification( $quoteUnverified );
            return SMSErrorDispatch::dispatch(SMSErrorDispatch::SMS_GENERAL_ERROR, $quoteUnverified, $hash_token );
        }

        // Was our SMS Message accepts by carrier?

        $done = false;
        $this->timesChecked = 0;

        do {
            // did we get a good response ?

            $smsResponseArr = $this->getSentSMSResponse( $responseData );

            if (isset($smsResponseArr['data'])) {
                $smsResponseData = $smsResponseArr['data'];
            }
            else {
                $this->notifyOTPViaEmailNotification( $quoteUnverified );
                return SMSErrorDispatch::dispatch(SMSErrorDispatch::SMS_GENERAL_ERROR, $quoteUnverified, $hash_token );
            }

            \Illuminate\Support\Facades\Log::info( self::class . "::generateQuoteVerificationRequest - responseArray : " . json_encode([
                "responseArray" => $smsResponseArr,
            ]));

            if (isset($smsResponseData['attributes'])) {
                if (isset($smsResponseData['attributes']['delivery_receipts'])) {
                    foreach($smsResponseData['attributes']['delivery_receipts'] as $receipt) {

                        \Illuminate\Support\Facades\Log::info( self::class . "::generateQuoteVerificationRequest - responseArray : " . json_encode([
                            "status_code" => $receipt['status_code'],
                        ]));

                        if($receipt['status_code'] === 1003) {

                            $resp = [
                                "success" => true,
                                "token"   => $hash_token,
                                "message" => $subject,
                                //    "results" => $results
                            ];

                            return response()->json( $resp );
                        }
                    }
                }
            }

            // failed, check again until we have reached max number of attempts
            if ($this->timesChecked < self::MAX_CHECKED_TIMES) {
                $this->timesChecked++;
                sleep(10);
            } else {
                $done = true;
            }
        }
        while(!$done);

        $this->notifyOTPViaEmailNotification( $quoteUnverified );
        return SMSErrorDispatch::dispatch(SMSErrorDispatch::SMS_GENERAL_ERROR, $quoteUnverified, $hash_token );

    }

    /**
     * @param $user
     * @param $quoteUnverified
     */
        private function sendNewQuoteLeadNotification( $user, $quoteUnverified ): void
    {
        // $action = new NewQuoteAction('New Quote Action', 'notification_action');
        // $notification = new NewQuoteGeneratedNotification('New Quote', 'You have received a new quote.', '/notification-icon', $action);
        // Notification::send(User::all(), $notification);

        $profile = Profile::where(["user_id" => $user->id])->first();

        AQLog::info(print_r([
            "Method" => "PhoneValidationModule::sendNewQuoteLeadNotification",
            "\$user->email" => $user->email,
            "\$user->name" => $user->name,
            "\$user" => $user,
            "\$quoteUnverified" => $quoteUnverified,
        ],true));

        AQLog::email(print_r([
            "subject" => "New Quote Lead Notification",
            "to" => [
                "name" => $user->name,
                "email" => $profile->contact_email,
                "quote" => $quoteUnverified
            ]
        ], true));

        if (env('RECEIVED_COPY_OF_QUOTE_LEAD')) {

            AQLog::email(print_r([
                "subject" => "New Quote Lead Notification",
                "to" => [
                    "name" => 'Support',
                    "email" => 'support@agentquoter.com',
                    "quote" => $quoteUnverified
                ]
            ], true));

            \Mail::to('support@agentquoter.com', 'Support')->send(new ViewQuoteLeadCCEmail(
                new ViewQuotedLeadContract($user, $quoteUnverified)
            ));

            AQLog::email(print_r([
                "subject" => "New Quote Lead Notification",
                "to" => [
                    "name" => 'Frank Decker',
                    "email" => 'frankdd3@gmail.com',
                    "quote" => $quoteUnverified
                ]
            ], true));

            \Mail::to('frankdd3@gmail.com', 'Frank Decker')->send(new ViewQuoteLeadCCEmail(
                new ViewQuotedLeadContract($user, $quoteUnverified)
            ));

        }

        \Mail::to($profile->contact_email, $user->name)->send(new ViewQuoteLeadEmail(
            new ViewQuotedLeadContract($user, $quoteUnverified)
        ));


    }

    /**
     * @param $quoteUnverified
     * @param $confirmation_token
     */
    private function sendNewQuoteNotification( $quoteUnverified, $confirmation_token): void
    {
        // $action = new NewQuoteAction('New Quote Action', 'notification_action');
        // $notification = new NewQuoteGeneratedNotification('New Quote', 'You have received a new quote.', '/notification-icon', $action);
        // Notification::send(User::all(), $notification);

        AQLog::email(print_r([
            "to" => [
                "name" => $quoteUnverified->name,
                "email" => $quoteUnverified->email
            ]
        ], true));

        \Mail::to($quoteUnverified->email, $quoteUnverified->name)->send(new ViewQuoteEmail(
            new ViewQuoteContract($quoteUnverified->name, $quoteUnverified->email, $quoteUnverified->domain, $confirmation_token)
        ));

    }

    /**
     * @param $quoteUnverified
     */
    protected function notifyOTPViaEmailNotification( $quoteUnverified ): void
    {
        // $action = new NewQuoteAction('New Quote Action', 'notification_action');
        // $notification = new NewQuoteGeneratedNotification('New Quote', 'You have received a new quote.', '/notification-icon', $action);
        // Notification::send(User::all(), $notification);

        AQLog::email(print_r([
            "to" => [
                "name" => $quoteUnverified->name,
                "email" => $quoteUnverified->email
            ]
        ], true));

        if (env('RECEIVE_EMAIL_COPY')) {

            AQLog::email(print_r([
                "subject" => "SMS Otp Verification Email",
                "to" => [
                    "name" => 'Support',
                    "email" => 'support@agentquoter.com',
                ]
            ], true));

            \Mail::to('support@agentquoter.com', 'Support')->send(new PendingSMSOtpVerificationEmail(
                new PendingSMSCodeVerificationContract($quoteUnverified->name, $quoteUnverified->email, $quoteUnverified->domain, $quoteUnverified->code)
            ));

            AQLog::email(print_r([
                "subject" => "SMS Otp Verification Email",
                "to" => [
                    "name" => 'Frank Decker',
                    "email" => 'frankdd3@gmail.com',
                ]
            ], true));

            \Mail::to('frankdd3@gmail.com', 'Frank Decker')->send(new PendingSMSOtpVerificationEmail(
                new PendingSMSCodeVerificationContract($quoteUnverified->name, $quoteUnverified->email, $quoteUnverified->domain, $quoteUnverified->code)
            ));

        }


        \Mail::to($quoteUnverified->email, $quoteUnverified->name)->send(new PendingSMSOtpVerificationEmail(
            new PendingSMSCodeVerificationContract($quoteUnverified->name, $quoteUnverified->email, $quoteUnverified->domain, $quoteUnverified->code)
        ));

    }

    public function onAction( $module, $data ) {

/*        return response()->json([
            "success" => true,
            "data_new" => $data,
        ]);*/

        if($data['action'] === 'update') {

            $config = json_decode($data['options'],true);

            $verifiedQuote = QuoteUnverified::where(
                'token', '=', $config['token'] )->first();

            Log::info( "PhoneValidation::onAction - update: " . json_encode($verifiedQuote) );
            Log::info( "PhoneValidation::onAction - config: " . json_encode($config) );

            if ( ! $verifiedQuote ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized request'
                ]);
            }

            $quoteRequest = \unserialize( $verifiedQuote['data'] );

            $quoteRequest['phone'] = $config['phone'];

            $quoteSerialized = \serialize( $quoteRequest );

            $code = \App\Libraries\OtpSecurity::generateNumericOTP(5);

            $quoteUnverified = QuoteUnverified::updateOrCreate([
               'token' =>  $verifiedQuote->token
            ], [
                'data' => $quoteSerialized,
                'phone' => $quoteRequest['phone'],
                'code' => $code,
                'expires_at' => (Carbon::now())->addMinutes(3)
            ]);

            return $this->generateQuoteVerificationRequest('Verification Re-sent', $code, $quoteUnverified, $verifiedQuote->token);

        } else if($data['action'] === 'resend') {
            $config = json_decode($data['options'],true);

            $verifiedQuote = QuoteUnverified::where(
                'token', '=', $config['token'] )->first();

            if ( ! $verifiedQuote ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized request'
                ]);
            }

            $code = '';

            for($cc = 0; $cc < 4; $cc++) {
                $code = \App\Libraries\OtpSecurity::generateNumericOTP(5);
                if(strlen($code) === 5) {
                    break;
                }
            }

            $quoteUnverified = QuoteUnverified::updateOrCreate([
               'token' =>  $verifiedQuote->token
            ], [
                'code' => $code,
                'attempts' => 0,
                'expires_at' => (Carbon::now())->addMinutes(3)
            ]);

            return $this->generateQuoteVerificationRequest('Verification Re-sent', $code, $quoteUnverified, $verifiedQuote->token);

        }
        else if($data['action'] === 'verify') {
            $config = json_decode($data['options'],true);

            Log::info( "PhoneValidation::onAction - config: " . json_encode($config) );

            $verifiedQuote = QuoteUnverified::where(
                'token', '=', $config['token'])->first();

            Log::info( "PhoneValidation::onAction - verify: " . json_encode($verifiedQuote) );

/*            return response()->json([
                "success" => false,
                "opt_expired" => true,
                "message" => 'OTP expired.'
            ]);*/

            if ( ! $this->liveMode ) {
                Log::info( "\nPhoneValidation::onAction - expires_at: " . $verifiedQuote->expires_at );
                Log::info( "\nPhoneValidation::onAction - NOW: " . Carbon::NOW() );
            }

            if ( false && $verifiedQuote->expires_at->lt(Carbon::NOW()) ) {

                $error = [
                    "success" => false,
                    "opt_expired" => true,
                    "message" => 'OTP expired.'
                ];

                Log::info( "\nPhoneValidation::onAction - error: " . json_encode($error) );

                return response()->json([
                    "success" => false,
                    "opt_expired" => true,
                    "message" => 'OTP expired.'
                ]);
            }

            Log::info( "\nPhoneValidation::onAction - config['verification_code'] : " . $config['verification_code'] );
            Log::info( "\nPhoneValidation::onAction - verifiedQuote->code : " . $verifiedQuote->code );

            if ( strval($config['verification_code']) === strval($verifiedQuote->code) ) {

                $error = [
                    "success" => false,
                    "opt_expired" => true,
                    "message" => $verifiedQuote->code
                ];

                Log::info( "\nPhoneValidation::onAction - verification_code (error) : " . json_encode($error) );

                // User::find()


                $quote = unserialize($verifiedQuote["data"]);

                $user = User::find($quote['user_id']);

                AQLog::info(print_r([
                    "Method" => "PhoneValidationModule::onAction",
                    "\$user" => $user,
                    "\$quote['user_id']" => $quote['user_id'],
                ],true));

                $this->sendNewQuoteLeadNotification( $user, $quote );

                return response()->json([
                    "success" => true,
                    "message" => 'Verification successful.',
                    "opt_expired" => false,
                    "redirect" => $data['host'] . '/quote/verified/?token=' . $config['token'],
                ]);

            } else {
                $verifiedQuote->attempts = intval( $verifiedQuote->attempts ) + 1;
                $verifiedQuote->save();

                return response()->json([
                    "success" => false,
                    "opt_expired" => false,
                    "message" => 'Verification code invalid.'
                ]);
            }

        }

        return response()->json([
           "success" => false,
           "module" => $module,
           "data" => $data
        ]);
    }

    public function onEdit( $module, $data ) {
    }

    public function onUpdate( $module, $data ) {

    }

    public function onRender( $module, $data ) {

/*        $parameters = '';
        $hasDollar = strstr($data->config['remote_site'], "?" );
        $first = true;
        foreach($data['parameters'] as $param_key => $param_val) {
            if ($first) {
                if ($hasDollar) {
                    $parameters .=  "&";
                } else {
                    $parameters .=  "?";
                }
                $parameters .=  $param_key . '=' . urlencode( $data['parameters'][$param_key] );
                $first = false;
            } else {
                $parameters .=  "&" . $param_key . '=' . urlencode( $data['parameters'][$param_key] );
            }
        }*/

	    // $url = $data->config['remote_site'] . $parameters;
        // $title = 'Patrick Affiliate Link';
	    // echo $url;

/*        $title = preg_replace('/([a-z])([A-Z])/s','$1 $2', $oldstr);

        $data['parameters'] */

        return response()->json([
            "success" => true,
            "data" => [ "userModule" => $module, "config" => $data['config'], "parameters" => $data['parameters']]
        ]);

        $view = View::make('custom_modules.termlife_module.render', []);

        $contents = $view->render();

	    return json_encode([
	        "success" => true,
            "output" => $contents
        ]);
    }

    public function getMethods() {
	    return [
                "POST" => [
                   "fname",
                   "lname",
                ],
                "GET" => [
                    "id"
                ]
        ];
    }

    public function getHooks() {
	    return [
	        "onInstall" => 'install',
            "onUnInstall" => 'unInstall',
	       // "onBoot" => 'boot',
	        "onUpdate" => 'onUpdate',
	        "onAction" => 'onAction',
	        "onEdit" => 'onEdit',
	        "onRender" => 'onRender',
        ];
    }
}
