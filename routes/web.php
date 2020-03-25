<?php

use App\Facades\AQLog;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserMessagesController;
use App\Models\TokenUser;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

// AQLog::info("IP Address: " . get_ip());

/*Route::group(
    [
        'middleware' => 'landing-pages.domains',
        'as', 'landing-pages.'
    ], function() {


    // Route::get('/', [\App\Http\Controllers\UserQuoteController::class, 'verify_quote'])->name('user.quote.verify.quote');
    Route::get('/aaaa', [\App\Http\Controllers\LandingPage::class, 'index'])->name('aaaaa');
    Route::post('/underwritten', [\App\Http\Controllers\InsuranceModuleControllers\TermLifePageModuleController::class, 'page'])->name('user.quote.insurance_modules.termlife');
    Route::post('/fe', [\App\Http\Controllers\InsuranceModuleControllers\FinalExpensePageModuleController::class, 'page'])->name('user.quote.insurance_modules.fe');

    Route::get('/quote/verify', [\App\Http\Controllers\UserQuoteController::class, 'verify_quote'])->name('user.quote.verify.quote');
    Route::get('/quote/verified', [\App\Http\Controllers\UserQuoteController::class, 'gen_verified_quote'])->name('user.quote.show.verified');

    // exit;

});*/



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
+--------+----------+----------------------------------------------------------+-----------------------+------------------------------------------------------------------------+------------------------------------------------------+
| Domain | Method   | URI                                                      | Name                  | Action                                                                 | Middleware                                           |
+--------+----------+----------------------------------------------------------+-----------------------+------------------------------------------------------------------------+------------------------------------------------------+
|        | GET|HEAD | _debugbar/assets/javascript                              | debugbar.assets.js    | Barryvdh\Debugbar\Controllers\AssetController@js                       | Barryvdh\Debugbar\Middleware\DebugbarEnabled,Closure |
|        | GET|HEAD | _debugbar/assets/stylesheets                             | debugbar.assets.css   | Barryvdh\Debugbar\Controllers\AssetController@css                      | Barryvdh\Debugbar\Middleware\DebugbarEnabled,Closure |
|        | DELETE   | _debugbar/cache/{key}/{tags?}                            | debugbar.cache.delete | Barryvdh\Debugbar\Controllers\CacheController@delete                   | Barryvdh\Debugbar\Middleware\DebugbarEnabled,Closure |
|        | GET|HEAD | _debugbar/clockwork/{id}                                 | debugbar.clockwork    | Barryvdh\Debugbar\Controllers\OpenHandlerController@clockwork          | Barryvdh\Debugbar\Middleware\DebugbarEnabled,Closure |
|        | GET|HEAD | _debugbar/open                                           | debugbar.openhandler  | Barryvdh\Debugbar\Controllers\OpenHandlerController@handle             | Barryvdh\Debugbar\Middleware\DebugbarEnabled,Closure |
|        | GET|HEAD | _debugbar/telescope/{id}                                 | debugbar.telescope    | Barryvdh\Debugbar\Controllers\TelescopeController@show                 | Barryvdh\Debugbar\Middleware\DebugbarEnabled,Closure |
|        | POST     | api/affiliate/admins                                     |                       | App\Http\Controllers\Api\AffiliateAdminsController@store               | api                                                  |
|        | POST     | api/affiliate/groups                                     |                       | App\Http\Controllers\Api\AffiliateGroupsController@store               | api                                                  |
|        | PUT      | api/affiliate/groups/{group}                             |                       | App\Http\Controllers\Api\AffiliateGroupsController@update              | api                                                  |
|        | DELETE   | api/affiliate/groups/{group}                             |                       | App\Http\Controllers\Api\AffiliateGroupsController@destroy             | api                                                  |
|        | PUT      | api/affiliate/user/groups/{group}                        |                       | App\Http\Controllers\Api\AffiliateUsersGroupController@update          | api                                                  |
|        | POST     | api/invites/admin/new                                    |                       | App\Http\Controllers\Api\InviteAdminsController@store                  | api                                                  |
|        | POST     | api/invites/manager/new                                  |                       | App\Http\Controllers\Api\InviteManagersController@store                | api                                                  |
|        | POST     | api/invites/new                                          |                       | App\Http\Controllers\Api\InviteUsersController@store                   | api                                                  |
|        | POST     | api/password/reset                                       |                       | App\Http\Controllers\Api\PasswordResetController@store                 | api                                                  |
|        | DELETE   | api/quote/delete                                         |                       | App\Http\Controllers\Api\QuoteController@destroy                       | api                                                  |
|        | DELETE   | api/quotes/delete                                        |                       | App\Http\Controllers\Api\QuotesController@destroy                      | api                                                  |
|        | GET|HEAD | api/user                                                 |                       | Closure                                                                | api,auth:api                                         |
|        | GET|HEAD | login                                                    | login                 | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest                                            |
|        | POST     | login                                                    |                       | App\Http\Controllers\Auth\LoginController@login                        | web,guest                                            |
|        | POST     | logout                                                   | logout                | App\Http\Controllers\Auth\LoginController@logout                       | web                                                  |
|        | POST     | password/email                                           | password.email        | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest                                            |
|        | GET|HEAD | password/reset                                           | password.request      | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest                                            |
|        | POST     | password/reset                                           | password.update       | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest                                            |
|        | GET|HEAD | password/reset/{token}                                   | password.reset        | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest                                            |
|        | POST     | register                                                 |                       | App\Http\Controllers\Auth\RegisterController@register                  | web,guest                                            |
|        | GET|HEAD | register                                                 | register              | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest                                            |
|        | POST     | telescope/telescope-api/cache                            |                       | Laravel\Telescope\Http\Controllers\CacheController@index               | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/cache/{telescopeEntryId}         |                       | Laravel\Telescope\Http\Controllers\CacheController@show                | telescope                                            |
|        | POST     | telescope/telescope-api/commands                         |                       | Laravel\Telescope\Http\Controllers\CommandsController@index            | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/commands/{telescopeEntryId}      |                       | Laravel\Telescope\Http\Controllers\CommandsController@show             | telescope                                            |
|        | POST     | telescope/telescope-api/dumps                            |                       | Laravel\Telescope\Http\Controllers\DumpController@index                | telescope                                            |
|        | POST     | telescope/telescope-api/events                           |                       | Laravel\Telescope\Http\Controllers\EventsController@index              | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/events/{telescopeEntryId}        |                       | Laravel\Telescope\Http\Controllers\EventsController@show               | telescope                                            |
|        | POST     | telescope/telescope-api/exceptions                       |                       | Laravel\Telescope\Http\Controllers\ExceptionController@index           | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/exceptions/{telescopeEntryId}    |                       | Laravel\Telescope\Http\Controllers\ExceptionController@show            | telescope                                            |
|        | POST     | telescope/telescope-api/gates                            |                       | Laravel\Telescope\Http\Controllers\GatesController@index               | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/gates/{telescopeEntryId}         |                       | Laravel\Telescope\Http\Controllers\GatesController@show                | telescope                                            |
|        | POST     | telescope/telescope-api/jobs                             |                       | Laravel\Telescope\Http\Controllers\QueueController@index               | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/jobs/{telescopeEntryId}          |                       | Laravel\Telescope\Http\Controllers\QueueController@show                | telescope                                            |
|        | POST     | telescope/telescope-api/logs                             |                       | Laravel\Telescope\Http\Controllers\LogController@index                 | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/logs/{telescopeEntryId}          |                       | Laravel\Telescope\Http\Controllers\LogController@show                  | telescope                                            |
|        | POST     | telescope/telescope-api/mail                             |                       | Laravel\Telescope\Http\Controllers\MailController@index                | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/mail/{telescopeEntryId}          |                       | Laravel\Telescope\Http\Controllers\MailController@show                 | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/mail/{telescopeEntryId}/download |                       | Laravel\Telescope\Http\Controllers\MailEmlController@show              | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/mail/{telescopeEntryId}/preview  |                       | Laravel\Telescope\Http\Controllers\MailHtmlController@show             | telescope                                            |
|        | POST     | telescope/telescope-api/models                           |                       | Laravel\Telescope\Http\Controllers\ModelsController@index              | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/models/{telescopeEntryId}        |                       | Laravel\Telescope\Http\Controllers\ModelsController@show               | telescope                                            |
|        | POST     | telescope/telescope-api/monitored-tags                   |                       | Laravel\Telescope\Http\Controllers\MonitoredTagController@store        | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/monitored-tags                   |                       | Laravel\Telescope\Http\Controllers\MonitoredTagController@index        | telescope                                            |
|        | POST     | telescope/telescope-api/monitored-tags/delete            |                       | Laravel\Telescope\Http\Controllers\MonitoredTagController@destroy      | telescope                                            |
|        | POST     | telescope/telescope-api/notifications                    |                       | Laravel\Telescope\Http\Controllers\NotificationsController@index       | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/notifications/{telescopeEntryId} |                       | Laravel\Telescope\Http\Controllers\NotificationsController@show        | telescope                                            |
|        | POST     | telescope/telescope-api/queries                          |                       | Laravel\Telescope\Http\Controllers\QueriesController@index             | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/queries/{telescopeEntryId}       |                       | Laravel\Telescope\Http\Controllers\QueriesController@show              | telescope                                            |
|        | POST     | telescope/telescope-api/redis                            |                       | Laravel\Telescope\Http\Controllers\RedisController@index               | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/redis/{telescopeEntryId}         |                       | Laravel\Telescope\Http\Controllers\RedisController@show                | telescope                                            |
|        | POST     | telescope/telescope-api/requests                         |                       | Laravel\Telescope\Http\Controllers\RequestsController@index            | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/requests/{telescopeEntryId}      |                       | Laravel\Telescope\Http\Controllers\RequestsController@show             | telescope                                            |
|        | POST     | telescope/telescope-api/schedule                         |                       | Laravel\Telescope\Http\Controllers\ScheduleController@index            | telescope                                            |
|        | GET|HEAD | telescope/telescope-api/schedule/{telescopeEntryId}      |                       | Laravel\Telescope\Http\Controllers\ScheduleController@show             | telescope                                            |
|        | POST     | telescope/telescope-api/toggle-recording                 |                       | Laravel\Telescope\Http\Controllers\RecordingController@toggle          | telescope                                            |
|        | GET|HEAD | telescope/{view?}                                        | telescope             | Laravel\Telescope\Http\Controllers\HomeController@index                | telescope                                            |
+--------+----------+----------------------------------------------------------+-----------------------+------------------------------------------------------------------------+------------------------------------------------------+

 */

/*Route::group(['domain' => config('agentquote.defaults.main.domain')], function() {
   Route::get('/', function() {
       return redirect(config('agentquote.defaults.routes.default'));
   }) ;
});*/

/*dd([
    request()->getHttpHost(),
    config('agentquote.defaults.main.vanity_domain'),
    request()->isMethod('get'),
    request()->is('/')
]);*/

/*if (request()->getHttpHost() === config('agentquote.defaults.main.vanity_domain') && request()->isMethod('get') && request()->is('/')) {
    Route::get('/', function () {
        return redirect(route('login'));
    });
}*/

const USER_ACTIVE = 1;


/* Route::get('/products-services/insurance/termlife-insurance', function () {
    return view('landing-page-sections', []);
});
 */
// exit;
/*
Route::get('/products-services/mortgage-insurance', function () {
    return view('landing-page-sections', []);
}); */

/* Route::get('/products-services/fe-insurance', function () {
    return view('landing-page-sections', []);
}); */
/*
Route::get('/products-services/life-insurance/termlife', function () {
    return view('landing-page-sections', []);
}); */

/* Route::get('/products-services/life-insurance', function () {
    return view('landing-page-sections', []);
}); */
/*
Route::get('/featured-tips/why-life-insurance-makes-sense', function () {
    return view('landing-page-featured-tip-1', []);
});

Route::get('/featured-tips/how-much-life-insurance-do-i-need', function () {
    return view('landing-page-featured-tip-2', []);
});

Route::get('/featured-tips/but-i-already-have-insurance', function () {
    return view('landing-page-featured-tip-3', []);
}); */

Route::get('/landing-page-sections', function () {
    return view('landing-page-sections');
});

Route::get('/component-builder', function () {
    return view('component-builder');
});

Route::domain(config('agentquote.defaults.main.vanity_domain'))->group(function() {
    Route::get('/', function () {
        return redirect(route('login'));
    });
});

Route::get('/l/{token}', function ($token, Request $request) {

    $tokenUser = TokenUser::where([
        'token' => $token
    ])->first();

    if ($tokenUser) {

        $user = User::where([
            'id' => $tokenUser->user_id
        ])->first();

        if ($user && $user->active === USER_ACTIVE) {
            Auth::loginUsingId($user->id);
            return response()->redirectTo('/dashboard');
        }
        else {
            abort(405);
        }

    }

    abort(405);

/*    dd([
        $tokenUser,
        $token,
        $user
    ]);*/
});

Route::group(['middleware' => ['auth']], function () {

    //dd(Auth::user()->id());
    //dnd(Auth::check());
	//dd(Auth::guest());landing-page/settings

    Route::get('/whmcs/clients', [\App\Http\Controllers\WHMCSClientController::class, 'index'])->name('whmcs.clients.index');
    Route::get('/whmcs/products', [\App\Http\Controllers\WHMCSProductController::class, 'index'])->name('whmcs.products.index');
    Route::get('/modules/add', [\App\Http\Controllers\CustomModulesController::class, 'add'])->name('custom.modules.add');
    Route::post('/modules/add', [\App\Http\Controllers\CustomModulesController::class, 'add_module'])->name('custom.modules.add.save');

    Route::get('/modules', [\App\Http\Controllers\CustomModulesController::class, 'index'])->name('custom.modules.index');
    Route::post('/modules/{id}', [\App\Http\Controllers\CustomModulesController::class, 'update'])->name('custom.modules.update');
    Route::delete('/modules/{id}', [\App\Http\Controllers\CustomModulesController::class, 'delete'])->name('custom.modules.delete');

    Route::get('/user/custom_modules/{userId}', [\App\Http\Controllers\UserCustomModulesController::class, 'show_custom_modules'])->name('custom.user.show_custom_modules.index');
    Route::get('/user/custom_module/{userId}', [\App\Http\Controllers\UserCustomModulesController::class, 'render'])->name('custom.user.render.module');
    Route::get('/user/modules', [\App\Http\Controllers\UserCustomModulesController::class, 'index'])->name('custom.user.modules.index');
    Route::post('/user/modules/{id}', [\App\Http\Controllers\UserCustomModulesController::class, 'update'])->name('custom.user.modules.update');
    Route::delete('/user/modules/{id}', [\App\Http\Controllers\UserCustomModulesController::class, 'delete'])->name('custom.user.modules.delete');

    Route::get('/messages', [\App\Http\Controllers\AgentMessagesController::class, 'index'])->name('messages');

    Route::get('/file-manager', [\App\Http\Controllers\FilesManagerController::class, 'create'])->name('file-manager.create.file');
    Route::post('/file-manager', [\App\Http\Controllers\FilesManagerController::class, 'store'])->name('file-manager.save.file');

    Route::get('/messages/acknowledge/{messageUser}', [\App\Http\Controllers\AgentMessagesController::class, 'acknowledge'])->name('messages.acknowledge');

    Route::get('/messages/new', [\App\Http\Controllers\MessagesController::class, 'create'])->name('message.compose');
    Route::get('/messages/{messageUser}', [\App\Http\Controllers\AgentMessagesController::class, 'show'])->name('message.show');
    Route::get('/messages/delete/{messageUser}', [\App\Http\Controllers\AgentMessagesController::class, 'destroy'])->name('message.show');

   // Route::get('/push', [\App\Http\Controllers\PushNotificationsController::class,'push'])->name('push');

    Route::get('/reports/logins', [\App\Http\Controllers\LoginsReportController::class, 'index']);
    Route::get('/reports/events', [\App\Http\Controllers\EventsReportController::class, 'index']);
    Route::get('/reports/recent_quotes', [\App\Http\Controllers\RecentQuotesController::class, 'index'])->name('recent.quotes');
    Route::get('/reports/carriers/top', [\App\Http\Controllers\TopQuotedCarriersReportsController::class, 'index']);

    // Route::get('/user/reports/quotes', [\App\Http\Controllers\RecentQuotesController::class, 'index'])->name('user.reports.quote');

    Route::get('/groups', [\App\Http\Controllers\AffiliateGroupsController::class, 'index'])->name('affiliate.groups.index');
    Route::get('/groups/new', [\App\Http\Controllers\AffiliateGroupsController::class, 'create'])->name('affiliate.groups.create');

    Route::get('/super/ad', [\App\Http\Controllers\SuperUserAdController::class, 'index'])->name('super.ad.index');
    Route::post('/super/ad', [\App\Http\Controllers\SuperUserAdController::class, 'store'])->name('super.ad.store');

    Route::get('/ads/underwritten', [\App\Http\Controllers\AffiliateAdUnderwrittenController::class, 'index'])->name('affiliate.ad.underwritten.index');
    Route::post('/ads/underwritten', [\App\Http\Controllers\AffiliateAdUnderwrittenController::class, 'store'])->name('affiliate.ad.underwritten.store');

    Route::get('/ads/sit', [\App\Http\Controllers\AffiliateAdSitController::class, 'index'])->name('affiliate.ad.sit.index');
    Route::post('/ads/sit', [\App\Http\Controllers\AffiliateAdSitController::class, 'store'])->name('affiliate.ad.sit.store');

    Route::get('/ads/fe', [\App\Http\Controllers\AffiliateAdFeController::class, 'index'])->name('affiliate.ad.fe.index');
    Route::post('/ads/fe', [\App\Http\Controllers\AffiliateAdFeController::class, 'store'])->name('affiliate.ad.fe.store');

    Route::get('/cpage', [\App\Http\Controllers\ContractPageController::class, 'create'])->name('affiliate.contract-page');

    Route::get('/affiliates', [\App\Http\Controllers\AffiliatesController::class, 'index'])->name('affiliates');
    Route::get('/admins', [\App\Http\Controllers\AdminsController::class, 'index'])->name('affiliate.admins');
    Route::get('/managers', [\App\Http\Controllers\ManagersController::class, 'index'])->name('affiliate.managers');
    Route::get('/agents', [\App\Http\Controllers\UsersController::class, 'index'])->name('affiliate.agents');

//	Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

	Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
	Route::get('/support', [\App\Http\Controllers\SupportController::class, 'index'])->name('support');
    //Route::get('/videos', [\App\Http\Controllers\VideosController::class, 'index'])->name('knowledge-base');
	Route::get('/knowledge-base', [\App\Http\Controllers\KnowledgeBaseController::class, 'index'])->name('knowledge-base');
	Route::get('/carrier-guides', [\App\Http\Controllers\GuidesController::class, 'index'])->name('knowledge-base');
	Route::get('/support/guides', [\App\Http\Controllers\GuidesController::class, 'guides'])->name('support.guides');

	Route::get('/videos', [\App\Http\Controllers\VideosController::class, 'index'])->name('knowledge-base');
	Route::get('/support/videos', [\App\Http\Controllers\VideosController::class, 'videos'])->name('support.videos');


	Route::get('/dashboard/super', [\App\Http\Controllers\DashboardController::class, 'super'])->name('dashboard.super');
	Route::get('/dashboard/affiliate', [\App\Http\Controllers\DashboardController::class, 'affiliate'])->name('dashboard.affiliate');
	Route::get('/dashboard/admin', [\App\Http\Controllers\DashboardController::class, 'admin'])->name('dashboard.admin');
	Route::get('/dashboard/manager', [\App\Http\Controllers\DashboardController::class, 'manager'])->name('dashboard.manager');
	Route::get('/dashboard/user', [\App\Http\Controllers\DashboardController::class, 'user'])->name('dashboard.user');

	Route::get('/reports/{id}', [\App\Http\Controllers\ReportsController::class, 'index'])->name('reports');

	Route::get('/user', [\App\Http\Controllers\UserController::class, 'index'])->name('user');

	Route::get('user/{id}/profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('user.profile.show');
	Route::put('user/{id}/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('user.profile.update');
	Route::post('user/{id}/profile', [\App\Http\Controllers\ProfileController::class, 'store'])->name('user.profile.store');

    Route::get('landing-page/user/{id}/profile', [\App\Http\Controllers\LandingPageController::class, 'show'])->name('user.landing-page.profile.show');
    Route::put('landing-page/user/{user}/profile', [\App\Http\Controllers\LandingPageController::class, 'update'])->name('user.landing-page.profile.update');
    Route::post('landing-page/user/{id}/profile', [\App\Http\Controllers\LandingPageController::class, 'store'])->name('user.landing-page.profile.store');

	Route::get('user/quotes', [\App\Http\Controllers\UserQuotesController::class, 'index'])->name('user.quotes.show');
	Route::get('user/quote', [\App\Http\Controllers\UserBackendQuoteController::class, 'quote'])->name('user.quote.show');
	Route::post('user/quote', [\App\Http\Controllers\UserBackendQuoteController::class, 'gen_quote'])->name('user.quote.generate');

	// Route::post('user/search/messages', [\App\Http\Controllers\UserMessagesController::class, 'search'])->name('user.search.messages');
	Route::get('user/leads', [\App\Http\Controllers\UserLeadsController::class, 'index'])->name('user.leads.show');
	Route::get('user/contacts', [\App\Http\Controllers\UserContactsController::class, 'index'])->name('user.contacts.show');

	Route::get('user/{id}/microsite', [\App\Http\Controllers\MicrositeController::class, 'show'])->name('user.microsite.show');
	Route::put('user/{id}/microsite', [\App\Http\Controllers\MicrositeController::class, 'update'])->name('user.microsite.update');
	Route::post('user/{id}/microsite', [\App\Http\Controllers\MicrositeController::class, 'store'])->name('user.microsite.store');

	Route::get('user/quotes', [\App\Http\Controllers\UserQuoteController::class, 'quotes'])->name('user.quotes.show');

	Route::get('user/{id}/account', [\App\Http\Controllers\MyAccountController::class, 'show'])->name('user.account.show');
	Route::put('user/{id}/account', [\App\Http\Controllers\MyAccountController::class, 'update'])->name('user.account.update');

	Route::put('account/{id}/security', [\App\Http\Controllers\MyAccountController::class, 'updatePassword'])->name('account.security.update.password');
	Route::put('account/{id}/forcepass', [\App\Http\Controllers\MyAccountController::class, 'updatePasswordForcePass'])->name('account.update.password.forcepass');

	Route::get('account/settings', [\App\Http\Controllers\MyAccountController::class, 'settings'])->name('account.settings');
	Route::get('account/security', [\App\Http\Controllers\MyAccountController::class, 'security'])->name('account.security');
    Route::get('account/fchangepass', [\App\Http\Controllers\MyAccountController::class, 'fchangepass'])->name('account.fchangepass.security');

	Route::get('profile/settings', [\App\Http\Controllers\ProfileController::class, 'settings'])->name('profile.settings');
	Route::get('/password', [\App\Http\Controllers\PasswordController::class, 'index'])->name('password');
	Route::get('landing-page/settings', [\App\Http\Controllers\LandingPageController::class, 'settings'])->name('microsite.settings');
	Route::get('user/analytics', [\App\Http\Controllers\UserGoogleAnalyticsController::class, 'settings'])->name('analytics.settings');

	Route::get('termlife/quote', [\App\Http\Controllers\TermlifeCarriersController::class, 'quote'])->name('termlife.carriers.quote');
	Route::get('carriers/termlife/settings', [\App\Http\Controllers\TermlifeCarriersController::class, 'settings'])->name('termlife.carriers.settings');
	Route::put('carriers/termlife/settings', [\App\Http\Controllers\TermlifeCarriersController::class, 'usettings'])->name('termlife.carriers.usettings');

	Route::get('carriers/sit/settings', [\App\Http\Controllers\SitCarriersController::class, 'settings'])->name('sit.carriers.settings');
	Route::put('carriers/sit/settings', [\App\Http\Controllers\SitCarriersController::class, 'usettings'])->name('sit.carriers.usettings');

	Route::get('carriers/siwl/settings', [\App\Http\Controllers\SiwlCarriersController::class, 'settings'])->name('siwl.carriers.settings');
	Route::put('carriers/siwl/settings', [\App\Http\Controllers\SiwlCarriersController::class, 'usettings'])->name('siwl.carriers.usettings');
	Route::get('carriers/settings', [\App\Http\Controllers\CarriersController::class, 'settings'])->name('carriers.settings');

});

Route::get('/beta/landing-page', [\App\Http\Controllers\LandingPage::class, 'index']);

Route::get('passgen', [\App\Http\Controllers\UtilsController::class, 'passgen'])->name('utils.passgen');
Route::get('imagetool/ratio', [\App\Http\Controllers\ImageToolsController::class, 'ratio'])->name('color.ratio');

Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\Auth\SecureLoginController::class, 'login']);
Route::post('logout',  [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::post('password/email', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset',  [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/reset', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('password/reset/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('register',  [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');

/*Route::group(['domain' => '{subdomain}.landing-pages.test'], function() {
	// Microsite - Pages
	Route::get('/{category}/{page}', function ($subdomain, $category, $page) {
		echo "$subdomain $category $page";
	});
	// Microsite - Home Page

	Route::get('/', 'MicrositeController@subdomain_home')->name('microsite.home');
	// Route::post('/user/messages', 'UserMessagesController@store')->name('user.messages.store');
	Route::post('/user/messages', function($subdomain) {
		return (new UserMessagesController())->store($subdomain, request());
	});
});*/


Route::get('checkout', [\App\Http\Controllers\SubscribeController::class,'index'])->name('checkout');

Route::get('/password_change/confirmation', [\App\Http\Controllers\PasswordChangeConfirmationController::class, 'index'])->name('password.reset.confirmation.index');

Route::get('device.login', [\App\Http\Controllers\Auth\DeviceLoginController::class, 'showDeviceLoginForm'])->name('device.login');
Route::get('device.logout', [LoginController::class, 'deviceLogout'])->name('device.logout');

Route::get('/signup', [\App\Http\Controllers\Subscribe::class, 'signup'])->name('mmlq.signup');

Route::get('/affiliates/signup', [\App\Http\Controllers\Subscribe::class,'affiliate_complete'])->name('affiliate.signup');
Route::get('/affiliates/signup/basic', [\App\Http\Controllers\Subscribe::class,'affiliate_basic'])->name('affiliate.signup.basic');

Route::get('/microsite/signup', [\App\Http\Controllers\Subscribe::class, 'aq2e'])->name('aq2e.signup');
Route::get('/signup', [\App\Http\Controllers\Subscribe::class, 'mmlq'])->name('mmlq-signup.signup');
Route::get('/aqmeeting/signup', [\App\Http\Controllers\Subscribe::class, 'aqmeeting'])->name('aqmeeting-signup.signup');
Route::get('/signup/completed', [\App\Http\Controllers\Subscribe::class, 'completed'])->name('mmlq.signup.completed');


Route::post('/webhook', [\App\Http\Controllers\Webhook::class,'index'])->name('webhook');

Route::post('/service/proxy', [\App\Http\Controllers\AQProxy::class,'proxy'])->name('aq.proxy.service');

Route::get('/completed', [\App\Http\Controllers\CompletedController::class,'index'])->name('thankyou.basic');

Route::get('/user/otl', [\App\Http\Controllers\OtpController::class,'login'])->name('aq.user.otp');
Route::post('/user/otp', [\App\Http\Controllers\OtpController::class,'generate'])->name('aq.user.genotp');
Route::post('/user/verify', [\App\Http\Controllers\VerifyController::class,'login'])->name('aq.user.verify');
Route::post('/user/jverify', [\App\Http\Controllers\VerifyController::class,'json_login'])->name('aq.user.json_verify');

Route::get('/register/push/notifications', [\App\Http\Controllers\PushNotificationsController::class, 'index']);

Route::get('/invite/confirmation', [\App\Http\Controllers\ConfirmationInvitesController::class,'index'])->name('invites.index');

Route::group(
    [
        'middleware' => ['landing-pages.subdomains']
       // 'subdomain' => '{subdomain}'/* . config('app.domain')*/,
    ],
    function() {

    Route::get('/', [\App\Http\Controllers\ProductPageController::class, 'index'])->name('landing-pages.domains.index');
    Route::get('/quote/verify', [\App\Http\Controllers\UserQuoteController::class, 'verify_quote'])->name('domains.user.quote.verify.quote');
    Route::get('/quote/verified', [\App\Http\Controllers\ModulesLandingPage::class, 'gen_verified_quote'])->name('domains.user.quote.show.verified');
    Route::get('/quote', [\App\Http\Controllers\ModulesLandingPage::class, 'gen_quote'])->name('domains.user.quote.show.quote');
    // exit;

});


Route::group(
    [
        'middleware' => ['landing-pages.domains']
    ],
    function () {

        Route::get('/', [\App\Http\Controllers\ProductPageController::class, 'index'])->name('landing-pages.domains.index');
        Route::get('/quote/verify', [\App\Http\Controllers\UserQuoteController::class, 'verify_quote'])->name('domains.user.quote.verify.quote');
        Route::get('/quote/verified', [\App\Http\Controllers\ModulesLandingPage::class, 'gen_verified_quote'])->name('domains.user.quote.show.verified');
        Route::get('/quote', [\App\Http\Controllers\ModulesLandingPage::class, 'gen_quote'])->name('domains.user.quote.show.quote');

    });

// Route::get('/quote/verify', [\App\Http\Controllers\UserQuoteController::class, 'verify_quote'])->name('user.quote.verify.quote');
// Route::get('/quote/verified', [\App\Http\Controllers\UserQuoteController::class, 'gen_verified_quote'])->name('user.quote.show.verified');

/*Route::get('/', function () {
    return redirect(route('login'));
});*/


/*Route::get('/', function () {
    return redirect(route('login'));
});*/
