<?php

namespace App\Libraries;

use App\Events\UserCreated;
use App\Models\AffiliateGroupUser;
use App\Models\Confirmation;
use App\Models\PendingUser;
use App\Models\RoleUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AQInvites
{
    const TOKEN_STRENGTH = 16;

    public static function removeConfirmation($confirmation_token) {
        $confirmation = Confirmation::where('confirmation_token', '=', $confirmation_token);
        if ($confirmation->exists()) {
            $confirmation->delete();
        }
    }

    public static function addUser($data): User
    {

        // $type = '\\App\\' . ucfirst($data['type']);
        // dd($type);
        // dd($data['affiliate']);
        // $typeable = $type::create($data); // Affiliate::create()

        $password = str_random(16);
        $password_hash = Hash::make( $password );

        $user_info = [
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'name' => $data['fname'] . ' ' . $data['lname'],
            'email' => $data['email'],
            'password' => $password_hash,
            'affiliate_id' => $data['affiliate']->id,
            'type_id' => $data['type_id'],
/*            'typeable_id' => $typeable->id,
            'typeable_type' => get_class($typeable)*/
        ];

        //  \Illuminate\Support\Facades\Log::info(print_r($user_info,true));

        // get the affiliate's default group
        $aff_grp_user = AffiliateGroupUser::where('user_id', '=', $data['affiliate']->id)->first();

        // \Illuminate\Support\Facades\Log::info(print_r($aff_grp_user,true));

        $user = User::create($user_info);

        AffiliateGroupUser::create([
            'affiliate_id' => $data['affiliate']->id,
            'group_id' => $aff_grp_user->group_id,
            'user_id' => $user->id,
        ]);

/*        RoleUser::create([
            'role_id' => 4,
            'user_id' => $user->id
        ]);*/

        $confirmation = Confirmation::create([
            'confirmation_token' => $data['confirmation_token'],
            'user_id' => $user->id,
            'confirmation_type' => $data['type_id'],
            'expires_at' =>  Carbon::now()->addDay()->toDateTimeString()
        ]);


        // announce our created user
        event(new UserCreated($user));

        // First name
        // Last name
        // Full name
        // Email
        // Password
        // Affiliate Id
        // Affiliate Group Id

       // dnd($confirmation);

       /* dnd([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'type_id' => $data['type_id'],
            'confirmation_id' => $confirmation->id,
            'expires_at' =>  Carbon::now()->addDay()->toDateTimeString()
        ]);

        echo "<br><br><br><br><br>";*/

      //  echo "<br><br><br><br><br>";

      //  dd($pending_user);

        return $user;
    }

    public static function addPendingUser($data)
    {

        $confirmation = Confirmation::create([
            'confirmation_token' => $data['confirmation_token'],
            'expires_at' =>  Carbon::now()->addDay()->toDateTimeString()
        ]);

        // dnd($confirmation);

        /* dnd([
             'fname' => $data['fname'],
             'lname' => $data['lname'],
             'email' => $data['email'],
             'type_id' => $data['type_id'],
             'confirmation_id' => $confirmation->id,
             'expires_at' =>  Carbon::now()->addDay()->toDateTimeString()
         ]);

         echo "<br><br><br><br><br>";*/

        $pending_user = PendingUser::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'type_id' => $data['type_id'],
            'confirmation_id' => $confirmation->id,
            'expires_at' =>  Carbon::now()->addDay()->toDateTimeString()
        ]);

        //  echo "<br><br><br><br><br>";

        //  dd($pending_user);

        return $pending_user;
    }

}
