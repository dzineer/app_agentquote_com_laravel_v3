<?php

namespace App\Http\Controllers\Api;

use App\Actions\NewQuoteAction;
use App\Blueprints\QuoteBluePrint;
use App\Contracts\PendingQuoteContract;
use App\Contracts\PendingSMSCodeVerificationContract;
use App\Events\QuoteCreated;
use App\Http\Controllers\Controller;
use App\Libraries\AQConfirmations;
use App\Facades\AQLog;
use App\Libraries\QuoteVerification;
use App\Quoters\SitQuoter;
use App\Quoters\SiwlQuoter;
use App\Quoters\TermlifeQuoter;
use App\Mail\PendingQuoteVerificationEmail;
use App\Mail\PendingSMSOtpVerificationEmail;
use App\Models\Affiliate;
use App\Models\AffiliateAd;
use App\Models\Microsite;
use App\Models\ColorsUser;
use App\Models\Profile;
use App\Models\UserSubdomain;
use App\Notifications\NewMessageNotification;
use App\Notifications\NewQuoteGeneratedNotification;
use App\Notifications\PhoneVerificationReceived;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use App\Libraries\FD3Color;
use Illuminate\Support\Facades\Hash;
use App\Models\QuoteUnverified;
use Illuminate\Support\Facades\Log;
use Dzineer\SMS\Facades\SMS;
use App\Libraries\SMSErrorDispatch;
use App\Libraries\Utilities\AQLogger;
use App\Exceptions\FlowrouteErrorException;

class UserQuoteController extends Controller
{
    private $debug = true;

    use AQLogger;
    use QuoteVerification;

    const UNDERWRITTEN_CATEGORY = 1;
    const SIT_CATEGORY = 2;
    const SIWL_CATEGORY = 4;

    private $liveMode = false;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function gen_verify(Request $request) {

        $data = $this->validate($request, [
            'user_id' => 'required',
        ]);

    	// echo print_r($request->all(),true); exit;

	    $resp = [];
	    $user = Auth::user();
	    $quoter = null;

	    if ($request->input('category') == '1') {
		    $quoter = new TermlifeQuoter();
	    } else if  ($request->input('category') == '2') {
		    $quoter = new SitQuoter();
	    } else if  ($request->input('category') == '4') {
		    $quoter = new SiwlQuoter();
	    }

/*        return [
            "success" => true,
            "message" => "Please check your email for quote verification. Thank you.",
            "data" => $user
        ];*/

	    $acct = $quoter->getAccount(1);
	    $fields = $request->all();

	    $user_id = $fields['user_id'];
	    $email = $fields['email'];
	    $phone = $fields['phone'];
	    $name = $fields['name'];

	   // echo print_r($fields,true); exit;

	    $mappedFields = $quoter->mapFields($fields);
        // TODO: generate hash based on quote request details

        // $results = $quoter->getQuote($user, $mappedFields);

        // $this->logQuoteEvent($user, $fields, $results);
        // echo print_r($results,true); exit;
        // return response()->json($results);
        // echo print_r($mappedFields,true); exit;

        $serializedData = \serialize( $fields );

       // echo print_r($serializedData,true); exit;

        $hash_token = hash('sha256', $serializedData );

        $res = QuoteUnverified::where('token', '=', $hash_token);

        if ($res->exists()) {
            $res->delete();
        }

        // echo print_r([$serializedData, $hash_token],true); exit;

        $code = $this->getRandomPhoneCode();

        $quoteUnverified = QuoteUnverified::create([
            'user_id' => $user_id,
            'email' => $email,
            'phone' => $phone,
            'name' => $name,
            'token' => $hash_token,
            'code' => $code,
            'domain' => $request->getHttpHost(),
            'data' => $serializedData,
            'expires_at' => (Carbon::now())->addMinutes(3)
        ]);

        AQLog::info("OTP Code: $code");

        // TODO: 1. Generate quote request event.
        // TODO: 2. Generate verification email.
        // TODO: 3. Render quote results. Allow customer to make changes to quote?

        // awlays send


        if ( true ) {
            return $this->generateQuoteVerification( $code, $quoteUnverified, $hash_token );
        }

        if ( ! $this->liveMode ) {
            $this->AQLog( "::onAction - verification code: " . $quoteUnverified->code . "" );
        }

        $resp = [
            "success" => true,
            "token" => $hash_token,
            "message" => "Thank you for your quote request. In order to view your quote, be sure to check your email and click the \"Verify my email address\" button.",
        //    "results" => $results
        ];

        // echo print_r([$serializedData, $hash_token, $resp],true); exit;

        // TODO: Create Quote Confirmation Table
        // $data = array_merge($data, ['confirmation_token' => $confirmation_token, 'type_id' => self::ADMIN_USER_TYPE, 'type' => 'user', 'affiliate' => $affiliate]);

        $this->sendNewQuoteNotification( $quoteUnverified, $hash_token );

	    return response()->json( $resp );
    }

    /**
     * @param $quoteUnverified
     */
    protected function notifyOTPViaEmailNotification( $quoteUnverified ): void
    {
        // $action = new NewQuoteAction('New Quote Action', 'notification_action');
        // $notification = new NewQuoteGeneratedNotification('New Quote', 'You have received a new quote.', '/notification-icon', $action);
        // Notification::send(User::all(), $notification);

        \Mail::to($quoteUnverified->email, $quoteUnverified->name)->send(new PendingSMSOtpVerificationEmail(
            new PendingSMSCodeVerificationContract($quoteUnverified->name, $quoteUnverified->email, $quoteUnverified->domain, $quoteUnverified->code)
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

        \Mail::to($quoteUnverified->email, $quoteUnverified->name)->send(new PendingQuoteVerificationEmail(
            new PendingQuoteContract($quoteUnverified->name, $quoteUnverified->email, $quoteUnverified->domain, $confirmation_token)
        ));

    }

    public function requote(Request $request) {

        $data = $this->validate($request, [
            'quote_id' => 'required',
        ]);

        $verifiedQuote = QuoteUnverified::where(
            'token', '=', $data['quote_id'] )->first();

        if ( ! $verifiedQuote ) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized request'
            ]);
        }

        $quoteRequest = \unserialize( $verifiedQuote['data'] );

        if($request->has('term')) {
            $quoteRequest['term'] = $request->input('term');
        }

        if($request->has('benefit')) {
            $quoteRequest['benefit'] = $request->input('benefit');
        }

       // dd($quoteRequest);

        $user = User::find($quoteRequest['user_id']);

        //echo print_r($request->all(),true); exit;
        $resp = [];
        $quote = null;

        // $this->logQuoteEvent($user, $fields, $resp);

        // echo print_r($results,true); exit;
        // return response()->json(  $resp );

        $use_logo = ! isset($_GET['o']) || ! strlen($_GET['o']) ? false : $_GET['o'] === 'logo' ? true : false ;

        $use_form_only = ! isset($_GET['form']) || ! strlen($_GET['form']) ? false : $_GET['form'] === 'true' ? true : false ;

        $page = [
            'name'=> 'quote',
            'title' => 'Quote'
        ];

        $data = [
            'options' => [
                'use_logo' => $use_logo
            ],
            'company' => [
                'name' => 'Agent Quoter',
                'phone' => [ '888-223-4773', '' ],
                'email' => 'support@agentquote.com',
                'address' => '22 St. Black Road Orlando, PL 3457'
            ],
            'branding' => [
                'company' => 'Agent Quoter',
                'logo' => [
                    'light' => '/templates/landing-pages/v1/images/AQ_Logo.png',
                    'dark' => '/templates/landing-pages/v1/images/AQ_Logo.png',
                ],
                'special_text' => 'We provide a full spectrum of mobile quoters and web applications for insurance agents. Focusing on Life insurance, Health, Financial Advisors, and P&C. Our quoters and website applications cover all stages of the program development life cycle and keep you one step ahead of the competition.',
                'copyright' => 'Agent Quote Inc.'
            ],
            'hours_available' => 'Mon–Fri: 9am–6pm; Sun: 10am–1pm',
            'page' => [
                'name'=> 'home',
                'title' => 'Home'
            ],

            'social_media' => [
                [ 'name' => 'facebook', 'icon' => 'fa-facebook', 'link' => 'https://facebook.com/agentquoter' ],
                [ 'name' => 'twitter', 'icon' => 'fa-twitter',  'link' =>  'https://twitter.com/agentquoter' ],
                //  [ 'name' => 'goggle_plus', 'icon' => 'fa-google-plus',  'link' =>  'https://google.com/agentquoter' ],
                [ 'name' => 'youtube', 'icon' => 'fa-youtube' , 'link' =>  'https://youtube.com/agentquoter' ],
                [ 'name' => 'linked_in', 'icon' => 'fa-linkedin' , 'link' =>  'https://linkedin.com/agentquoter' ],
                [ 'name' => 'linked_in', 'icon' => 'fa-instagram' , 'link' =>  'https://instagram.com/agentquoter' ],
                // [ 'name' => 'rss', 'icon' => 'fa-rss' , 'link' =>  'https://rss.com/agentquoter' ],
            ],

            'menus' => [
                'show' => ! $use_form_only,
                'main' => $use_form_only ? [
                    [ 'label' => 'Home', 'name' => 'home', 'link' => '#home', 'active' => $page['name'] === 'home' ],
                ] :
                    [
                        [ 'label' => 'Home', 'name' => 'home', 'link' => '#home', 'active' => $page['name'] === 'home' ],
                        [ 'label' => 'Process', 'name' => 'process', 'link' => '#process', 'active' => $page['name'] === 'process'  ],
                        [ 'label' => 'Life', 'name' => 'life', 'link' => '#life', 'active' => $page['name'] === 'life'  ],
                        [ 'label' => 'Glossary', 'name' => 'glossary', 'link' => '#glossary', 'active' => $page['name'] === 'glossary'  ],
                        //    [ 'label' => 'Services', 'link' => '#services', 'active' => false  ],
                        //    [ 'label' => 'News', 'link' => '#news', 'active' => false  ],
                        [ 'label' => 'Contact', 'name' => 'contact', 'link' => '#contacts', 'active' => $page['name'] === 'contact'  ],
                    ]
            ],

            'phone' => ['888-223-4773', ''],
            'process' => [
                [
                    "header" => "Getting A quote",
                    "body" => [
                        "The simplest and easiest part is getting a quote using the Term Life Quote Engine. Once the information is completed on the input page and the \"Get A Quote\" button is clicked, the product comparison page is displayed. The first thing noticed, there are four rate classifications shown in each product strip. After the underwriting process is complete, the applicant can expect to receive an offer of one of these underwriting classifications from the insurance carrier if the application is not rated or declined.",
                        "The criteria used by each insurance carrier to determine the underwriting classification can be reviewed by viewing the Underwriting Guidelines (Labeled Health Profile). The link is along the grey bar just below the App Request button. These are just guidelines, there are many other issues that can influence the underwriting process.",
                        "There are three drop down boxes at the top of the comparison page, \"Benefit Amount\", \"Term Length\" and the Model Premium. Changing the information in each of these three areas allows for instant re-quotes.",
                    ],
                ],
                [
                    "header" => "Completing Application Request",
                    "body" => [
                        "To start the process, the applicant must click the \"App Request\" button and complete the form."
                    ]
                ],
                [
                    "header" => "Phone Interview",
                    "body" => [
                        "Once the application request form is completed and submitted, the applicant can expect to be contacted by phone to verify the request and answer the necessary questions to complete an application."
                    ]
                ],
                [
                    "header" => "Scheduling a Medical Exam",
                    "body" => [
                        "In most cases an appointment will be arranged for a licensed Nurse, Para-Med or a Doctor to visit with the applicant to perform a physical exam. The exam in most cases takes place at the applicants home or office. The extent of the exam is determined by the age and the amount of insurance the applicant is applying for. At the very least, the exam will include blood and urine and a blood pressure check. The cost of the exam is covered by the insurance carrier."
                    ]
                ],
                [
                    "header" => "Underwriting Review",
                    "body" => [
                        "Once the exam is completed and the signed application is received by the insurance carrier, the underwriting process will begin. The time it takes to complete the underwriting process is determined by how quickly the insurance carrier can gather all the necessary information needed to make an informed decision."
                    ]
                ],
                [
                    "header" => "Carrier Offer",
                    "body" => [
                        "After the underwriting process is complete, the applicant will be notified of the Insurance Carrier's decision to make an offer or not make an offer."
                    ]
                ],
                [
                    "header" => "Decision",
                    "body" => [
                        "If the Insurance Carrier makes an offer, the applicant then must decide to accept or decline the offer. The applicant is not obligated for any underwriting expenses."
                    ]
                ],
                [
                    "header" => "Policy Delivery",
                    "body" => [
                        "If the applicant decides to accept the Insurance Carrier's offer, then arrangements are made for policy delivery and payment. Once the policy is placed in force, the applicant (now insured) can discontinue the policy at anytime without penalty. However, in most cases, the policy will lapse after 30 days of non-payment."
                    ]
                ]

            ],
            'life' => [
                [
                    "header" => "Why do I need Life Insurance?",
                    "body" => [
                        "Life insurance is an essential part of financial planning. One reason most people buy life insurance is to replace income that would be lost with the death of a wage earner. The cash provided by life insurance also can help ensure that your dependents are not burdened with significant debt when you die. Life insurance proceeds could mean your dependents will not have to sell assets to pay outstanding bills or taxes. An important feature of life insurance is that generally no income tax is payable on proceeds paid to beneficiaries. The death benefit of a life policy owned by a C corporation may be included in the calculation of the alternative minimum tax."
                    ],
                ],
                [
                    "header" => "How much Insurance do I need?",
                    "body" => [
                        "Before buying life insurance, you should assemble personal financial information and review your family's needs. There are a number of factors to consider when determining how much protection you should have. These include:",
                        "Although there is no substitute for a careful evaluation of the amount of coverage needed to meet your needs, one rule of thumb used: five to seven times annual gross income.",
                        "If you want to be more precise, take the time and complete the Needs Analyzer"
                    ],
                ],
                [
                    "header" => "Choosing A Plan",
                    "body" => [
                        "Buying life insurance is not like any other purchase you will make. When you pay your premiums, you're buying the future financial security of your family that only life insurance can provide. Among its many uses, life insurance helps ensure that, when you die, your dependents will have the financial resources needed to protect their home and the income needed to run a household.",
                        "Choosing a life insurance product is an important decision, but it often can be complicated. As with any other major purchase, it is important that you understand your needs and the options available to you.",
                        "The main types of life insurance available are term and permanent. Term insurance provides protection for a specified period of time. Permanent insurance provides lifelong protection."
                    ],
                ],
                [
                    "header" => "",
                    "body" => [
                        ""
                    ],
                ]
            ],
            "glossary" => [
                [
                    "key" => "Accidental Death Benefit:",
                    "value" => "An extra death benefit amount that is paid out in addition to the face amount of the policy if the insured dies as the result of an accident. It cost extra to get this benefit, and usually cannot exceed $250,000 to $300,000, and cannot exceed more than the face amount of the policy."
                ],
                [
                    "key" => "Accelerated Death Benefit Option:",
                    "value" => "In the event of terminal illness, usually l year or less, the insured has the option to withdraw some of the death benefit for personal use. Usually no more than 25% and usually not exceeding $250,000. This option is usually free and is offered by some insurance companies."
                ],
                [
                    "key" => "Age:",
                    "value" => "Most insurance companies calculate age by using the age you are nearest to. Example: Insured is 45 and it is January, and the insured's birthday is in March. If the insurance company was calculating age nearest, the insured would be considered age 46 for the purpose of calculating rates."
                ],
                [
                    "key" => "Assignment:",
                    "value" => "The transfer of the ownership rights of a Life Insurance policy from one person to another."
                ],
                [
                    "key" => "Aviation Hazard:",
                    "value" => "The extra hazard of death or injury resulting from participation in aeronautics. It usually does not include fare-paying passengers in licensed aircraft. This generally will require paying extra premium or the waiving of certain benefits of coverage."
                ],
                [
                    "key" => "Backdating:",
                    "value" => "A procedure for making the effective date of a policy earlier than the application date. Backdating is often used to make the age at issue lower than it actually was in order to get lower premium. State laws often limit to six months the time to which policies can be backdated ."
                ],
                [
                    "key" => "Beneficiary:",
                    "value" => "The person designated to receive the death benefit when the insured dies."
                ],
                [
                    "key" => "Business Insurance:",
                    "value" => "Policies written for business purposes, such as key employee, buy-sell, business loan protection, etc."
                ],
                [
                    "key" => "Buy-Sell Agreement:",
                    "value" => "An agreement among owners in a business which states the under certain conditions, i.e., disability or death, the person leaving the business or in case of death, his heirs are legally obligated to sell their interest to the remaining owners, and the remaining owners are legally obligated to buy at a price fixed in the Buy-Sell agreement. The funding vehicles are either disability or life insurance or both."
                ],
                [
                    "key" => "Children's Term Insurance Rider:",
                    "value" => "Provides term insurance to the insured's dependents. It is a flat premium for all his dependents and the benefit usually is not less than $1,000 or more than $10,000."
                ],
                [
                    "key" => "Collateral Assignment:",
                    "value" => "Assign all or part of a life insurance policy as security for a loan. If the insured dies the creditor would receive only the amount due on the loan."
                ],
                [
                    "key" => "Conditional Binding Receipt:",
                    "value" => "This is the more exact terminology for what is often called a binding receipt. It provides that if premium accompanies an application, the coverage will be in force from the date of application, or medical examination, if any, whichever is later, provided the insurer would have issued the coverage on the basis of the facts revealed on the application, medical examination and other usual sources of underwriting information. This coverage usually has a limit until the policy is delivered and all delivery requirements are met. A life and health insurance policy without a conditional binding receipt is not effective until it is delivered to the insured and the premium is paid."
                ],
                [
                    "key" => "Contestable Clause:",
                    "value" => "A provision in an insurance policy setting forth the conditions under which or the period of time during which the insurer may contest or void the policy. After that time has lapsed, normally two years, the policy cannot be contested. Example: Suicide."
                ],
                [
                    "key" => "Contingent Beneficiary:",
                    "value" => "A person or persons named to receive policy benefits if the primary beneficiary is deceased at the time the benefits become payable."
                ],
                [
                    "key" => "Convertible (conversion):",
                    "value" => "A policy that may be changed to another form by contractual provision and without evidence of insurability. Most term policies are convertible into permanent insurance."
                ],
                [
                    "key" => "Credit Insurance:",
                    "value" => "Insurance on a debtor in favor of a creditor to pay off the balance due on a loan in the event of the death of the debtor."
                ],
                [
                    "key" => "Cross Purchase:",
                    "value" => "A form of business life insurance in which each party purchases life insurance on each other."
                ],
                [
                    "key" => "Decreasing Term:",
                    "value" => "A form of life insurance that provides a death benefit which declines throughout the term of the contract, reaching zero at the end of the term."
                ],
                [
                    "key" => "Delivery:",
                    "value" => "The actual placing of a life insurance policy in the hands of an insured."
                ],
                [
                    "key" => "Double Indemnity:",
                    "value" => "Payment of twice the basic benefit in the event of loss resulting from specified causes or under specified circumstances."
                ],
                [
                    "key" => "Entity Agreement:",
                    "value" => "A buy-sell agreement in which the company agrees to purchase the interest of a deceased or disabled partner."
                ],
                [
                    "key" => "Evidence of Insurability:",
                    "value" => "The statement of information needed for the underwriting of an insurance policy."
                ],
                [
                    "key" => "Examination:",
                    "value" => "The medical examination of an applicant for Life Insurance."
                ],
                [
                    "key" => "Examiner:",
                    "value" => "A physician, nurse, or para-med appointed by the medical director of a life insurance company to examine applicants."
                ],
                [
                    "key" => "Expiry:",
                    "value" => "The termination of a term life insurance policy at the end of its period of coverage."
                ],
                [
                    "key" => "Face:",
                    "value" => "The first page of a life insurance policy."
                ],
                [
                    "key" => "Face Amount:",
                    "value" => "The amount of insurance provided by the terms of an insurance contract, usually found on the face of the policy. In a life insurance policy, the death benefit."
                ],
                [
                    "key" => "Fixed Benefit:",
                    "value" => "A benefit, the dollar amount of which does not vary."
                ],
                [
                    "key" => "Free Look:",
                    "value" => "A period of time(usually 10, 20, or 30 days) during which a policyholder may examine a newly issued individual life insurance policy, and surrender it in exchange for a full refund of premium if not satisfied for any reason."
                ],
                [
                    "key" => "Insurability:",
                    "value" => "Acceptability to the insurer of an application for insurance."
                ],
                [
                    "key" => "Insurable Interest:",
                    "value" => "You have an insurable interest in the insured if upon the death of the insured you would suffer financial loss."
                ],
                [
                    "key" => "Insurance:",
                    "value" => "A formal social device for reducing risk by transferring the risks of several individual entities to an insurer. The insurer agrees, for a consideration, to pay for the loss in the amount specified in the contract."
                ],
                [
                    "key" => "Insurance Policy:",
                    "value" => "The printed form which serves as the contract between an insurer and an insured."
                ],
                [
                    "key" => "Insured:",
                    "value" => "The party, who is being insured. In life insurance, it is the person because of his or her death the insurance company would pay out a death benefit to a designated beneficiary."
                ],
                [
                    "key" => "Insurer:",
                    "value" => "The company that pays out the death benefits if the insured dies."
                ],
                [
                    "key" => "Irrevocable Beneficiary:",
                    "value" => "A beneficiary that cannot be changed without his or her consent."
                ],
                [
                    "key" => "Key Person (Key Man) Insurance:",
                    "value" => "Insurance on the life of a key employee whose death would cause the employer financial loss. The policy is owned and payable to the employer."
                ],
                [
                    "key" => "Lapsed Policy:",
                    "value" => "A Insurance policy which has been allowed to expire because of nonpayment of premiums. In a cash value life insurance policy such as Whole Life or Universal Life the policy could expire because the cash value account reached a zero balance and no premium payments are being made to replenish it."
                ],
                [
                    "key" => "Level Term Insurance:",
                    "value" => "A type of policy which provides coverage at a fixed rate of payments for a limited period of time. After that period expires, coverage at the previous rate is no longer guaranteed."
                ],
                [
                    "key" => "Life Expectancy:",
                    "value" => "The average number of years remaining for a person of a given age to live as shown on the mortality or annuity table used as a reference."
                ],
                [
                    "key" => "Life Insurance:",
                    "value" => "An agreement that guarantees the payment of a stated amount of monetary benefits upon the death of the insured."
                ],
                [
                    "key" => "Medical Information Bureau (MIB):",
                    "value" => "A data service that stores coded information on the health histories of persons who have applied for insurance from subscribing companies in the past. Most Life insurers subscribe to this bureau to get more complete underwriting information."
                ],
                [
                    "key" => "Mortality Charge:",
                    "value" => "The charge for the element of pure insurance protection in a life insurance policy."
                ],
                [
                    "key" => "Mortality Cost:",
                    "value" => "The first factor considered in life insurance premium rates. Insurers have an idea of the probability that any person will die at any particular age; this is the information shown on a mortality table."
                ],
                [
                    "key" => "Mortality Rate:",
                    "value" => "The number of deaths in a group of people, usually expressed as deaths per thousand."
                ],
                [
                    "key" => "Mortality Table:",
                    "value" => "A table showing the incidence of death at specified ages."
                ],
                [
                    "key" => "Mortgage Insurance:",
                    "value" => "A life policy covering a mortgagor from which the benefits are intended to pay off the balance due on a mortgage upon the death of the insured."
                ],
                [
                    "key" => "Nonmedical (Non-Med):",
                    "value" => "A contract of life insurance underwritten on the basis of an insured's statement of his health with no medical examination required."
                ],
                [
                    "key" => "Not Taken:",
                    "value" => "Policies applied for and issued but rejected by the proposed owner and not paid for."
                ],
                [
                    "key" => "Occupational Hazard:",
                    "value" => "A condition in an occupation that increases the peril of accident, sickness, or death. It usually will mean higher premiums."
                ],
                [
                    "key" => "Ownership:",
                    "value" => "All rights, benefits and privileges under life insurance policies are controlled by their owners. Policy owners may or may not be the insured. Ownership may be assigned or transferred by written request of current owner."
                ],
                [
                    "key" => "Permanent Life Insurance:",
                    "value" => "A term loosely applied to Life Insurance policy forms other than Group and Term, usually Cash Value Life Insurance, such as Whole Life Insurance or Universal Life."
                ],
                [
                    "key" => "Policy Fee:",
                    "value" => "The policy fee is a flat dollar amount add to each policy."
                ],
                [
                    "key" => "Preauthorized Check Plan:",
                    "value" => "A premium-paying arrangement by which the policy owner authorizes the insurer to draft money from his or her bank account for the payments. This is usually done on a monthly basis."
                ],
                [
                    "key" => "Preferred Risk:",
                    "value" => "Any risk considered to be better than the standard risk on which the premium rate was calculated."
                ],
                [
                    "key" => "Premium:",
                    "value" => "The price of insurance protection for a specified risk for a specified period of time."
                ],
                [
                    "key" => "Primary Beneficiary:",
                    "value" => "The beneficiary named as first in line to receive proceeds or benefits from a policy when they become due."
                ],
                [
                    "key" => "Provisions:",
                    "value" => "Statements contained in an insurance policy which explain the benefits, conditions and other features of the insurance contract."
                ],
                [
                    "key" => "Rated:",
                    "value" => "Coverage's issued at a higher rate than standard."
                ],
                [
                    "key" => "Renewable Term:",
                    "value" => "Term insurance that may be renewed for another term without evidence of insurability. Level term usually turns into renewable term with increasing premiums after the level premium period."
                ],
                [
                    "key" => "Replacement:",
                    "value" => "A new policy written to take the place of one currently in force."
                ],
                [
                    "key" => "Revocable Beneficiary:",
                    "value" => "The beneficiary in a life insurance policy in which the owner reserves the right to revoke or change the beneficiary. Most policies are written with a revocable beneficiary."
                ],
                [
                    "key" => "Rider:",
                    "value" => "An attachment to a policy that modifies its conditions by expanding or restricting benefits or excluding certain conditions from coverage."
                ],
                [
                    "key" => "Standard Risk:",
                    "value" => "A risk that is on a par with those on which the rate has been based in the areas of health, physical condition, and lifestyle. An average risk, not subject to rate loading or restrictions because of health. At one time the best class of risk was the standard class. As the insurers improved their underwriting skills, they were able to define those in very good health and offer them lower rates with better underwriting classes."
                ],
                [
                    "key" => "Stock Purchase Agreement:",
                    "value" => "A formal buy-sell agreement whereby each stockholder is bound by the agreement to purchase the shares of a deceased stockholder and the heirs are obligated to sell. This agreement is usually funded with life insurance."
                ],
                [
                    "key" => "Stock Redemption Agreement:",
                    "value" => "A formal buy-sell agreement whereby the corporation is bound by the agreement to purchase the shares of a deceased stockholder and the heirs are obliged to sell. This agreement is usually funded with life insurance."
                ],
                [
                    "key" => "Underwriter:",
                    "value" => "A technician trained in evaluating risks and determining rates and coverage for them. When an application is submitted to the insurer, it is the underwriter who gathers all the necessary information to determine whether a person is a preferred risk, a standard risk, or rated."
                ],
                [
                    "key" => "Underwriting:",
                    "value" => "It is what the underwriter does to determine the class of risk an applicant will be placed in."
                ],
                [
                    "key" => "Universal Life:",
                    "value" => "Universal life insurance (often shortened to UL) is a type of permanent life insurance. Under the terms of the policy, the excess of premium payments above the current cost of insurance is credited to the cash value of the policy. The cash value is credited each month with interest, and the policy is debited each month by a cost of insurance (COI) charge, as well as any other policy charges and fees which are drawn from the cash value, even if no premium payment is made that month. Interest credited to the account is determined by the insurer, but has a contractual minimum rate."
                ],
                [
                    "key" => "Waiver of Premium:",
                    "value" => "A provision of a life insurance policy which continues the coverage without further premium payments if the insured becomes totally disabled."
                ],
                [
                    "key" => "Whole Life Insurance:",
                    "value" => "Whole life insurance, is a life insurance policy that remains in force for the insured's whole life and requires (in most cases) premiums to be paid every year into the policy."
                ]
            ]


        ];

        if ($quoteRequest['category'] == '1') {
            $quoter = new TermlifeQuoter();
            $data['insure_module'] = 'underwritten';
        } else if  ($quoteRequest['category'] == '2') {
            $quoter = new SitQuoter();
            $data['insure_module'] = 'simplified_issue';
        } else if  ($quoteRequest['category'] == '4') {
            $quoter = new SiwlQuoter();
            $data['insure_module'] = 'final_expense';
        }

        $acct = $quoter->getAccount(1);

        $fields = $quoteRequest;
        //echo print_r($fields,true); exit;

        $mappedFields = $quoter->mapFields($fields);

        $resp = $quoter->getQuote($user, $mappedFields);

        $data['quote_results'] = print_r($resp,true);
        $data['quote_results'] = json_encode($resp);

        $data['quote_id'] = $verifiedQuote['id'];
        $data['user_id'] = $user['id'];

        return response()->json([
            "success" => true,
            "quote_results" => $data['quote_results']
        ]);

        // return view('landing-pages.v1.quote_modules.' . $data['insure_module'] . '.quote.index-quote-results', $data);

    }

    public function validate_code(Request $request) {
        $data = $request->validate([
           'token' => 'required',
           'verification_code' => 'required',
        ]);

        if ($data['verification_code'] === '123456') {

            return response()->json([
                "success" => true,
                "message" => 'Verification successful.',
                "redirect" => $request->getSchemeAndHttpHost() . '/quote/verified/?token=' . $data['token'],
                "data" => $data
            ]);

        } else {

            return response()->json([
                "success" => false,
                "message" => 'Validation not successful.'
            ]);

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $reason
     * @param $quoteUnverified
     * @param string $hash_token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponseDispatch( $reason, $quoteUnverified, string $hash_token ): \Illuminate\Http\JsonResponse {
        $resp = [
            "success" => false,
            "token"   => $hash_token,
            "message" => "SMS Delivery failure. Check your email for your 5-digit Code, then type it below.",
            //    "results" => $results
        ];

        switch( $reason ) {
            case SMSErrorDispatch::SMS_REJECTED_BY_CARRIER:
                return response()->json( $resp );

            case SMSErrorDispatch::SMS_GENERAL_ERROR:
                $resp["message"] =  "Error has occurred. Please try again later.";
                return response()->json( $resp );

        }

        return response()->json( $resp );
    }

    private function logQuoteEvent($user, array $fields, $results): void
    {
        $fields['user_id'] = $user->id;
        $fields['affiliate_id'] = $user->affiliate_id;

        $notification = new NewQuoteGeneratedNotification([$user], "New Quote Generated", "A new quote was generated.", function($id, $notification, $canNotify) {
            // dd([$id, $notification, $canNotify]);
        }, \App\Events\ExampleEvent::class);

//        Notification::send($user, $notification);

       event(
            new QuoteCreated(
                new QuoteBluePrint(
                    $user->affiliate_id,
                    $fields['user_id'],
                    $fields['age'],
                    $fields['age_or_date'],
                    $fields['state'],
                    $fields['month'],
                    $fields['day'],
                    $fields['year'],
                    $fields['gender'],
                    $fields['term'],
                    $fields['tobacco'],
                    $fields['benefit'],
                    $fields['period'],
                    $fields['category']
                ),
                $user,
                $results,
                3,
                $notification
            )
        );
    }

    /**
     * @return int
     */
    private function getRandomPhoneCode(): int {
        return \App\Libraries\OtpSecurity::generateNumericOTP(5);
        return (string) mt_rand( 10000, 99999 );
    }

    // Function to generate OTP
    private function generateNumericOTP($n) {

        // all numeric digits
        $generator = "1357902468";

        // Iterate for n-times and pick a single character
        // from generator and append it to $result

        // Login for generating a random character from generator
        //     ---generate a random number
        //     ---take modulus of same with length of generator (say i)
        //     ---append the character at place (i) from generator to result

        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }

        // Return result
        return $result;
    }

    /**
     * @param int $code
     * @param $quoteUnverified
     * @param string $hash_token
     * @param $response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function generateQuoteVerification(
        int $code,
        $quoteUnverified,
        string $hash_token
    ): \Illuminate\Http\JsonResponse {

        try {
            // $this->sendStringSMS( "Hey Patrick Pegram", $quoteUnverified );
            // send code

            $responseArr = [];

            $responseArray = $this->sendOTPSMS( $code, $quoteUnverified );

            AQLog::networkResponse("\nsendOTPSMS - Response Array: " . json_encode($responseArray) . "\n");

            // log results

            AQLog::info(print_r([
                "response" => $responseArray,
            ], true));

            // did we get data and an id ?

            if (isset($responseArr['data']) && isset($responseArr['data']['id'])) {

                try {

                    $id = $responseArr['data']['id'];

                    $responseArray = $this->getResponse( $id );

                    AQLog::info(print_r([
                        "status" => "after getResponse call",
                        "response" => $responseArray,
                    ], true));

                    // if our OTP SMS message failed
                    if ( isset( $responseArray['errors'] ) ) {

                        throw new FlowrouteErrorException(json_encode([
                            'status' => 'Throwing FlowrouteErrorException',
                            'errors' => $responseArray['errors']
                        ]));

                    }

                    $responseData = $responseArray["data"];
                    $username = config( 'services.flowroute.access_key' );
                    $password = config( 'services.flowroute.secret_key' );

                    if (isset($responseArray['data']['id'])) {
                        $responseArr = $this->getResponse($responseArray['data']['id']);
                    } else { // something went wrong

                        throw new FlowrouteErrorException(json_encode([
                            'status' => 'Throwing FlowrouteErrorException',
                            'errors' => 'no id returned form flowroute'
                        ]));

                    }

                    AQLog::networkResponse("\nResponse Array: " . json_encode($responseArr) . "\n");

                    \Illuminate\Support\Facades\Log::info( self::class . "::gen_verify -  link : " . $responseData['links']['self'] );

                    // if our SMS failed to arrive to phone for any reason
                    if ( isset( $responseArr['errors'] ) ) {

                        throw new FlowrouteErrorException(json_encode([
                            'status' => 'Throwing FlowrouteErrorException',
                            'errors' => $responseArray['errors']
                        ]));

                    }

                    // $receipts = $responseArr['data']['attributes']['status'];
                    $attributes = $responseArr['data']['attributes'];
                    $this->AQLog( ":: - attributes: " . json_encode( $attributes ) . "" );
                    $receipts = $attributes['delivery_receipts'];

                    AQLog::networkResponse("\nReceipts: " . json_encode($receipts) . "\n");

                    $this->AQLog( ":: - receipts: " . json_encode( $receipts ) . "" );

                    // Was our SMS Message accepts by carrier?
                    if ( !count($receipts) || $receipts[0]['status_code_description'] !== "Message accepted by Carrier" ) {
                        $this->AQLog( ":: - status_code or status failure: " . json_encode( $responseData ) . "" );

                        throw new FlowrouteErrorException(json_encode([
                            'status' => 'Throwing FlowrouteErrorException',
                            'errors' => 'Message not accepted by carrier'
                        ]));


                    } else {

                        $resp = [
                            "success" => true,
                            "token"   => $hash_token,
                            "message" => "",
                            //    "results" => $results
                        ];
                        $this->AQLog( ":: - status successful: " . json_encode( $resp ) . "" );

                        AQLog::info(print_r($resp, true));

                        return response()->json( $resp );
                    }

                }
                catch (\GuzzleHttp\Exception\ClientException $e) {

                    AQLog::info(print_r([
                        "status" => "\GuzzleHttp\Exception\ClientException",
                        "Exception" => $e->getMessage(),
                    ], true));

                    throw new FlowrouteErrorException(json_encode([
                        'status' => 'Throwing FlowrouteErrorException',
                        "Exception" => $e->getMessage(),
                    ]));

                }

            } else {

                throw new FlowrouteErrorException(json_encode([
                    'status' => 'Throwing FlowrouteErrorException',
                    "Exception" => 'No data was returned from flowroute',
                    "details" => print_r($responseArr, true)
                ]));

            }

        }
        catch (FlowrouteErrorException $fre) {

            AQLog::info(print_r([
                "status" => "\App\Exception\FlowrouteErrorException",
                "Exception" => $fre->getMessage(),
            ], true));

            // since they could not receive OTP via SMS send via email.
            $this->notifyOTPViaEmailNotification( $quoteUnverified );
            // handle our error response
            return SMSErrorDispatch::dispatch(SMSErrorDispatch::SMS_DELIVERY_FAILURE, $quoteUnverified, $hash_token );

        }


        // $this->Log( "::onAction - link check response: " . $response . "" );
    }
}
