<?php

namespace App\Libraries;

use App\Models\AffiliateGroupUser;
use App\Models\Confirmation;
use App\Models\PendingUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AQPasswordReset
{
    const TOKEN_STRENGTH = 16;
    const PASSWORD_RESET_TYPE = 999;

    public static function removeConfirmation($confirmation_token) {
        $confirmation = Confirmation::where('confirmation_token', '=', $confirmation_token);
        if ($confirmation->exists()) {
            $confirmation->delete();
        }
    }

    public static function resetPasswordConfirmation($data)
    {

        // $type = '\\App\\' . ucfirst($data['type']);
        // dd($type);
        // dd($data['affiliate']);
        // $typeable = $type::create($data); // Affiliate::create()

        $confirmation = Confirmation::create([
            'confirmation_token' => $data['confirmation_token'],
            'user_id' => $data['user_id'],
            'confirmation_type' => $data['type_id'],
            'expires_at' =>  Carbon::now()->addDay()->toDateTimeString()
        ]);

        return $confirmation;
    }



}