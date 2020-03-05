<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Libraries\AQInvites;
use App\Models\Confirmation;
use Illuminate\Support\Facades\Auth;

class ConfirmationInvitesController extends Controller
{
    public function index() {
        $data = $this->validate(request(), [
            'confirmation_token' => 'required'
        ]);

        $confirmation = Confirmation::where('confirmation_token', '=', $data['confirmation_token'])->first();

        if ($confirmation) {
            //
            Auth::loginUsingId($confirmation->user_id);

            return response()->redirectTo('/account/fchangepass?confirmation_token='.$data['confirmation_token']);
        } else {
            throw new InvalidRequestException("Error, invalid request.");
        }
    }
}