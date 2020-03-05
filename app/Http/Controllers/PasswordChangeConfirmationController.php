<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Models\Confirmation;
use Illuminate\Support\Facades\Auth;

class PasswordChangeConfirmationController extends Controller
{
    public function index() {

        $data = $this->validate(request(), [
            'confirmation_token' => 'required'
        ]);

        $confirmation = Confirmation::where('confirmation_token', '=', $data['confirmation_token'])->first();

        // dd($confirmation);

        if ($confirmation) {
            //
            Auth::loginUsingId($confirmation->user_id);
            $user = Auth::user();

            return response()->redirectTo('/account/fchangepass?confirmation_token='.$data['confirmation_token']);
        } else {
            throw new InvalidRequestException("Error, invalid request.");
        }
    }
}