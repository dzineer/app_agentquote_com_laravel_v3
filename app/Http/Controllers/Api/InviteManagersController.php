<?php

namespace App\Http\Controllers\Api;

use App\Contracts\PendingUserContract;
use App\Libraries\AQConfirmations;
use App\Libraries\AQInvites;
use App\Mail\PendingAdminVerificationEmail;
use App\Mail\PendingManagerVerificationEmail;
use App\Models\Affiliate;
use App\Models\PendingUser;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InviteManagersController extends Controller
{
    const TOKEN_STRENGTH = 16;
    const MANAGER_USER_TYPE = 4;

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'email' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'affiliate_id' => 'required',
        ]);

        // make sure we have an affiliate before continuing
        $affiliate = Affiliate::findOrFail($data['affiliate_id']);

        $confirmation_token = AQConfirmations::generateConfirmationToken();

        $data = array_merge($data, ['confirmation_token' => $confirmation_token, 'type_id' => self::MANAGER_USER_TYPE, 'type' => 'user', 'affiliate' => $affiliate]);

        $manager = AQInvites::addUser($data);

        \Mail::to($data['email'], $data['fname'])->send(new PendingManagerVerificationEmail(
            new PendingUserContract($data['fname'], $data['lname'], $data['email'], $confirmation_token)
        ));

        return response()->json(["success" => true, "message" => "Invitation sent successfully", "manager" => $manager]);
    }
}
