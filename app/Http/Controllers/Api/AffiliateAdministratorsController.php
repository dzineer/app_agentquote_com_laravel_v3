<?php

namespace App\Http\Controllers\Api;

use App\Models\Affiliate;
use App\Models\AffiliateBillingCoupon;
use App\Models\AffiliateCoupon;
use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use App\Models\RoleUser;
use App\User;
use Dzineer\LaravelAdminLte\Menu\Filters\SubmenuFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AffiliateAdministratorsController extends Controller
{
    const ADMINISTRATOR_USER = 3;
    const MY_MOBILE_LIFE_QUOTER = 1;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function update(Request $request)
    {
/*        return response()->json([
            'success' => false,
            'message' => $request->all()
        ]);*/

        $affiliate_user = Auth::user();

        if (!$affiliate_user->is_affiliate()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $data = $this->validate($request, [
            'user_id' => 'required'
        ]);

        $administrator = User::find($data['user_id']);

        $updated = false;

        if ($administrator) {

            if ($request->has('fname')) {
	            $administrator->fname = $request->input('fname');
	            $administrator->save();
                $updated = true;
            }

            if ($request->has('lname')) {
	            $administrator->lname = $request->input('lname');
	            $administrator->save();
                $updated = true;
            }


            if($request->has('email')) {

                if(User::where('email', '=',$request->input('email'))->exists()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Email already being used.'
                    ]);
                } else {
	                $administrator->email = $request->input('email');
	                $administrator->save();
                    $updated = true;
                }

            }

            if ($updated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Manager updated successfully.'
                ]);
            }

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Operation.'
            ]);
        }

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
}
