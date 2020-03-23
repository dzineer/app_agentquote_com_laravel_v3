<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\APIController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/app_module', [\App\Http\Controllers\Api\AppCustomModulesController::class, 'action'])->name('app.modules.action');

Route::post('/password/reset', [\App\Http\Controllers\Api\PasswordResetController::class, 'store']);
Route::post('/password/super_reset', 'Api\SuperPasswordResetController@store');

Route::post('/user/affiliate/change', [\App\Http\Controllers\Api\SuperUserAffiliatesController::class, 'update']);

Route::put('/affiliate/administrator', [\App\Http\Controllers\Api\AffiliateAdministratorsController::class, 'update']);
Route::put('/affiliate/manager', [\App\Http\Controllers\Api\AffiliateManagersController::class, 'update']);

Route::get('/affiliate/code/{id}', 'Api\SuperAffiliateCodesController@index');

Route::post('/invites/new', 'Api\InviteUsersController@store');
Route::post('/invites/administrator/new', 'Api\InviteAdminsController@store');

Route::post('/invites/manager/new', 'Api\InviteManagersController@store');
Route::post('/invites/manager/new', 'Api\InviteManagersController@store');

Route::post('/register/push/notifications', [\App\Http\Controllers\PushNotificationsController::class,'store']);


Route::delete('/quote/delete', 'Api\QuoteController@destroy');
Route::delete('/quotes/delete', 'Api\QuotesController@destroy');

Route::post('/affiliate/admins', 'Api\AffiliateAdminsController@store');

Route::post('/affiliate/groups', 'Api\AffiliateGroupsController@store');

Route::put('/affiliate/groups/{group}', 'Api\AffiliateGroupsController@update');
Route::delete('/affiliate/groups/{group}', 'Api\AffiliateGroupsController@destroy');

Route::put('/affiliate/user/groups/{group}', 'Api\AffiliateUsersGroupController@update');

Route::put('/user/update', 'Api\UsersController@update');
Route::put('/affiliate/update', 'Api\AffiliatesController@update');
Route::post('/affiliate/store', 'Api\AffiliatesController@store');
Route::put('/affiliate/code/{id}', 'Api\AffiliateCodesController@update');

Route::post('/notifications/read', 'Api\AffiliateCodesController@update');

Route::post('/message', [\App\Http\Controllers\Api\MessagesController::class,'store'])->name('message.send');

Route::post('/notifications/mark/read', [\App\Http\Controllers\Api\NotificationsController::class,'update'])->name('notifications.mark.read');

Route::post('/notifications/delete/all', [\App\Http\Controllers\Api\NotificationsController::class,'destroy_all'])->name('notifications.delete.all');
Route::post('/notifications/delete/{id}', [\App\Http\Controllers\Api\NotificationsController::class,'destroy'])->name('notification.delete');

Route::post('/user/quote/generate', [\App\Http\Controllers\Api\UserQuoteController::class, 'gen_verify'])->name('api.user.quote.generate');
Route::post('/user/quote/requote', [\App\Http\Controllers\Api\UserQuoteController::class, 'requote'])->name('api.user.quote.requote');
Route::post('/user/quote/validate', [\App\Http\Controllers\Api\UserQuoteController::class, 'validate_code'])->name('api.user.quote.validate_code');

Route::get('/user/custom_modules/{userId}', [\App\Http\Controllers\UserCustomModulesController::class, 'show_custom_modules'])->name('custom.user.show_custom_modules.index');
Route::get('/user/custom_module/{userId}', [\App\Http\Controllers\UserCustomModulesController::class, 'render'])->name('custom.user.render.module');
Route::post('/user/custom_module/{id}', [\App\Http\Controllers\Api\UserCustomModulesController::class, 'update'])->name('custom.user.modules.update');

// Subscriptions Users Api
Route::post('/user.subscriptions',  [\App\Http\Controllers\Api\SubscriptionUsersApiController::class, 'getSubscriptions'])->name('api-request.user.subscriptions');

// Products Users Api
Route::post('/user.assignProduct',  [\App\Http\Controllers\Api\ProductUsersApiController::class, 'assignUserProduct'])->name('api-request.user.assign-product');
Route::post('/user.removeProduct',  [\App\Http\Controllers\Api\ProductUsersApiController::class, 'removeUserProduct'])->name('api-request.user.remove-product');

// Users Api
Route::post('/user.get',  [\App\Http\Controllers\Api\UsersApiController::class, 'getUser'])->name('api-request.user.get');
Route::post('/user.password.update',  [\App\Http\Controllers\Api\UsersApiController::class, 'changePassword'])->name('api-request.user.password-update');
Route::post('/user.disable',  [\App\Http\Controllers\Api\UsersApiController::class, 'disableSUser'])->name('api-request.user.disable');
Route::post('/user.enable',  [\App\Http\Controllers\Api\UsersApiController::class, 'enableUser'])->name('api-request.user.enable');

// Affiliates Api
Route::post('/affiliate.get',  [\App\Http\Controllers\Api\AffiliatesApiController::class, 'getAffiliate'])->name('api-request.affiliate.get');
Route::post('/affiliate.add',  [\App\Http\Controllers\Api\AffiliatesApiController::class, 'storeAffiliate'])->name('api-request.affiliate.add');
Route::post('/affiliate.disable',  [\App\Http\Controllers\Api\AffiliatesApiController::class, 'disableAffiliate'])->name('api-request.affiliate.disable');
Route::post('/affiliate.enable',  [\App\Http\Controllers\Api\AffiliatesApiController::class, 'enableAffiliate'])->name('api-request.affiliate.enable');

// Landing Page Users Api
Route::post('/user.landingPage.get',  [\App\Http\Controllers\Api\LandingPageUsersApiController::class, 'getLandingPageUser'])->name('api-request.user.landing-page.get');
Route::post('/user.landingPage.disable',  [\App\Http\Controllers\Api\LandingPageUsersApiController::class, 'disableLandingPageUser'])->name('api-request.user.landing-page.disable');
Route::post('/user.landingPage.enable',  [\App\Http\Controllers\Api\LandingPageUsersApiController::class, 'enableLandingPageUser'])->name('api-request.user.landing-page.enable');

// Quoter Users Api
Route::post('/user.quoter.get',  [\App\Http\Controllers\Api\QuoterUsersApiController::class, 'getQuoterUser'])->name('api-request.user.quoter.get');
Route::post('/user.quoter.disable',  [\App\Http\Controllers\Api\QuoterUsersApiController::class, 'disableQuoterUser'])->name('api-request.user.quoter.disable');
Route::post('/user.quoter.enable',  [\App\Http\Controllers\Api\QuoterUsersApiController::class, 'enableQuoterUser'])->name('api-request.user.quoter.enable');
