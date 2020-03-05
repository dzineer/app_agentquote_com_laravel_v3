<?php
use App\Http\Controllers\UserMessagesController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
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
+--------+----------+------------------------+------------------+------------------------------------------------------------------------+--------------+
| Domain | Method   | URI                    | Name             | Action                                                                 | Middleware   |
+--------+----------+------------------------+------------------+------------------------------------------------------------------------+--------------+
|        | GET|HEAD | api/user               |                  | Closure                                                                | api,auth:api |
|        | GET|HEAD | login                  | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST     | login                  |                  | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | POST     | logout                 | logout           | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | POST     | password/email         | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    |
|        | GET|HEAD | password/reset         | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    |
|        | POST     | password/reset         |                  | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    |
|        | GET|HEAD | password/reset/{token} | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    |
|        | GET|HEAD | register               | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
|        | POST     | register               |                  | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
+--------+----------+------------------------+------------------+------------------------------------------------------------------------+--------------+

 */

Auth::routes();

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


Route::get('checkout', 'SubscribeController@index')->name('checkout');
/*Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');*/

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
/*Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');*/

Route::get('device.login', 'Auth\DeviceLoginController@showDeviceLoginForm')->name('device.login');
Route::get('device.logout', 'Auth\LoginController@deviceLogout')->name('device.logout');
Route::get('device.logout', 'Auth\LoginController@deviceLogout')->name('device.logout');

Route::get('/signup_new', 'Subscribe2@signup')->name('mmlq.signup2');
Route::get('/signup_new/completed', 'Subscribe2@completed')->name('mmlq.signup2.completed');
Route::get('/signup', 'Subscribe@signup')->name('mmlq.signup');
Route::get('/affiliates/sign-up', 'Subscribe@affiliate')->name('affiliate.signup');
Route::get('/aq2e/sign-up', 'Subscribe@aq2e')->name('aq2e.signup');
Route::get('/mmlq/sign-up', 'Subscribe@mmlq')->name('mmlq-signup.signup');
Route::get('/signup/completed', 'Subscribe@completed')->name('mmlq.signup.completed');
Route::post('/webhook', 'Webhook@index')->name('webhook');
Route::post('/service/proxy', 'AQProxy@proxy')->name('aq.proxy.service');
Route::get('/complete', 'CompletedController@index')->name('thankyou.basic');

Route::group(['middleware' => ['auth']], function () {

	//dnd(Auth::check());
	//dd(Auth::guest());

	Route::get('/', 'HomeController@index');
	Route::get('/dashboard', 'HomeController@index')->name('dashboard');
	Route::get('/dashboard/super', 'DashboardController@super')->name('dashboard.super');
	Route::get('/dashboard/admin', 'DashboardController@admin')->name('dashboard.admin');
	Route::get('/dashboard/manager', 'DashboardController@manager')->name('dashboard.manager');
	Route::get('/dashboard/user', 'DashboardController@user')->name('dashboard.user');

	Route::get('/user', 'UserController@index')->name('user');

	Route::get('user/{id}/profile', 'ProfileController@show')->name('user.profile.show');
	Route::put('user/{id}/profile', 'ProfileController@update')->name('user.profile.update');
	Route::post('user/{id}/profile', 'ProfileController@store')->name('user.profile.store');

	Route::get('user/quotes', 'UserQuotesController@index')->name('user.quotes.show');
	Route::get('user/quote', 'UserQuoteController@quote')->name('user.quote.show');
	Route::post('user/quote', 'UserQuoteController@gen_quote')->name('user.quote.generate');
	Route::get('user/messages', 'UserMessagesController@index')->name('user.messages.show');

	Route::delete('user/messages/{id}', 'UserMessagesController@destroy')->name('user.message.destroy');
	Route::post('user/search/messages', 'UserMessagesController@search')->name('user.search.messages');
	Route::get('user/leads', 'UserLeadsController@index')->name('user.leads.show');
	Route::get('user/contacts', 'UserContactsController@index')->name('user.contacts.show');

	Route::get('user/{id}/microsite', 'MicrositeController@show')->name('user.microsite.show');
	Route::put('user/{id}/microsite', 'MicrositeController@update')->name('user.microsite.update');
	Route::post('user/{id}/microsite', 'MicrositeController@store')->name('user.microsite.store');

	Route::get('user/quotes', 'UserQuoteController@quotes')->name('user.quotes.show');

	Route::get('user/{id}/account', 'MyAccountController@show')->name('user.account.show');
	Route::put('user/{id}/account', 'MyAccountController@update')->name('user.account.update');

	Route::put('account/{id}/security', 'MyAccountController@updatePassword')->name('account.security.update.password');
	Route::get('account/settings', 'MyAccountController@settings')->name('account.settings');
	Route::get('account/security', 'MyAccountController@security')->name('account.security');
	Route::get('profile/settings', 'ProfileController@settings')->name('profile.settings');
	Route::get('/password', 'PasswordController@index')->name('password');
	Route::get('microsite/settings', 'MicrositeController@settings')->name('microsite.settings');

	Route::get('termlife/quote', 'TermlifeCarriersController@quote')->name('termlife.carriers.quote');
	Route::get('carriers/termlife/settings', 'TermlifeCarriersController@settings')->name('termlife.carriers.settings');
	Route::put('carriers/termlife/settings', 'TermlifeCarriersController@usettings')->name('termlife.carriers.usettings');

	Route::get('carriers/sit/settings', 'SitCarriersController@settings')->name('sit.carriers.settings');
	Route::put('carriers/sit/settings', 'SitCarriersController@usettings')->name('sit.carriers.usettings');

	Route::get('carriers/siwl/settings', 'SiwlCarriersController@settings')->name('siwl.carriers.settings');
	Route::put('carriers/siwl/settings', 'SiwlCarriersController@usettings')->name('siwl.carriers.usettings');
	Route::get('carriers/settings', 'CarriersController@settings')->name('carriers.settings');

});
