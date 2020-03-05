<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 11/12/18
 * Time: 12:45 PM
 */

namespace App\Http\Controllers;
use App\Libraries\ProductConfig;
use App\Libraries\ZohoProxyUpdate;
use App\Models\InvoiceItemUser;
use App\Models\PlanSubscription;
use App\Models\InvoiceUser;
use App\Models\Profile;
use App\Models\RoleUser;
use App\Models\SubscriptionUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class CompletedController {
	public function index() {
		return view('completed.basic', [ 'header' => 'Your Product Has Been Added!', 'footer' => 'Please check your email for more details.' ]);
		return view('completed.basic', [ 'header' => 'Your Product Has Been Added!', 'footer' => 'Please check your email to confirm your account.' ]);
	}
}