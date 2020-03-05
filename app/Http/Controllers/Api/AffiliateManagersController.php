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

class AffiliateManagersController extends Controller
{
    const MANAGER_USER = 4;
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

        $manager = User::find($data['user_id']);

        $updated = false;

        if ($manager) {

            if ($request->has('fname')) {
                $manager->fname = $request->input('fname');
                $manager->save();
                $updated = true;
            }

            if ($request->has('lname')) {
                $manager->lname = $request->input('lname');
                $manager->save();
                $updated = true;
            }


            if($request->has('email')) {

                if(User::where('email', '=',$request->input('email'))->exists()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Email already being used.'
                    ]);
                } else {
                    $manager->email = $request->input('email');
                    $manager->save();
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
