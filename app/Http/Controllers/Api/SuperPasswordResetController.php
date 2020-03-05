<?php

namespace App\Http\Controllers\Api;

use App\Contracts\UserContract;
use App\Events\PasswordResetRequest;
use App\Libraries\AQConfirmations;
use App\Libraries\AQPasswordReset;
use App\Mail\PasswordResetVerification;
use App\Models\Affiliate;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SuperPasswordResetController extends Controller
{
    const TOKEN_STRENGTH = 16;
    const ADMIN_USER_TYPE = 3;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'user_id' => 'required',
        ]);

        $super_user = Auth::user();

        if (!$super_user->is_super()) {
            return response()->json(["success" => false, "message" => "Invalid request."]);
        }

        $user = User::where("id", '=', $data['user_id'])->first();

        if (! $user) {
            return response()->json(["success" => false, "message" => "User does not exist!"]);
        }

        $confirmation_token = AQConfirmations::generateConfirmationToken();

        $data = array_merge($data, ['confirmation_token' => $confirmation_token, 'type_id' => $user->type_id, 'user_id' => $user->id, 'type' => 'user']);

        $confirmation = AQPasswordReset::resetPasswordConfirmation($data);

        // notify laravel a password reset was requested.
        event(new PasswordResetRequest($user));

        \Mail::to($user['email'], $user['fname'])->send(new PasswordResetVerification(
            new UserContract($user['fname'], $user['lname'], $user['email'], $confirmation_token)
        ));

        return response()->json(["success" => true, "message" => "Password reset request sent successfully." ]);
    }
}
