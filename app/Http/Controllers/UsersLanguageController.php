<?php

namespace App\Http\Controllers;

use App\Models\UserLanguage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Facades\AQLog;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Class UsersLanguageController
 * @package App\Http\Controllers
 */
class UsersLanguageController extends BackendController
{
    /**
     * @return array|string
     * @throws \Throwable
     */
    public function settings()
	{

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

	  //  dnd($this->loggedInUser);

        $languages = UserLanguage::languages($this->loggedInUser->id);

        $data = [
            "user" => $this->loggedInUser,
            "languages" => $languages,
        ];

        // dd($data);

		return view('profile.languages.index', $data);
	}

    public function usettings(Request $request) {

        $user_id = $this->loggedInUser->id;
        $settings = array();
        $settings['languages'] = array();

        $form = $request->all();

        $inserts = [];
        $deletes = [];

        foreach( $form as $field_name => $field_value ) {

            if ( strstr($field_name, "hidden_language__" ) != false ) {
                $arr = explode('__', $field_name );
                $id = $arr[1];
                $key = 'language_' . $id;
                // echo "<br>arr: <br>" . print_r( $arr, true );
                $settings['languages'][ $key ]['hidden'] = $field_value;

                $deletes[] = [
                    "language_id" => $field_value,
                    "user_id" => $this->loggedInUser->id
                ];
            }
            else if ( strstr($field_name, "language_" ) != false ) {
                $settings['languages'][ $field_name ]['value'] = $field_value;

                $inserts[] = [
                    "language_id" => $field_value,
                    "user_id" => $this->loggedInUser->id
                ];

            }
        }


        dd($inserts);
        dd($deletes);

        foreach ($inserts as $v) {
            VarDumper::dump($v);
        }

        foreach ($inserts as $v) {
            VarDumper::dump($deletes);
        }

        die(1);

        foreach( $settings['languages'] as $language ) {
            if( $language['hidden'] == 0 ) { // not set before
                if ( isset( $language['value'] ) ) { // should we set this?
                    CategoriesInsurance::addCarrier($user_id, $language["value"], 1);
                }

            }
            else if ( isset( $language['hidden'] ) && $language['hidden'] != 0 ) { // we already have this carrier
                if ( ! isset( $language['value'] ) ) { // do we still have this carrier
                    CategoriesInsurance::removeCarrier($user_id, $language["hidden"], 1);
                }
            }
        }

        $carriers_termLife = CategoriesInsurance::getCarriers($user_id,1);

        $message = 'Carriers updated';

        return view('termlife-carriers', ['carriers' => $carriers_termLife, 'message' => $message ] );

    }

	private function filter($arr) {
        return $arr;
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, $id)
    {
        $data = $this->validate($request, [
            'languages',
        ]);


        DB::beginTransaction();

        // get rid of all the current values for the user

        UserLanguage::where([
            'user_id' => $this->loggedInUser->id
        ])->delete();

        // insert all new language values for current user

        // we do this in case we want to filter this before continuing...
        $filtered = $this->filter($data);
        $languages = $filtered['languages'];

        $inserts = [];

        foreach($languages as $languageId) {
            $inserts[] = [
                "language_id" => $languageId,
                "user_id" => $this->loggedInUser->id
            ];
        }

        if (count($inserts)) {
            UserLanguage::insert($inserts);
        }

//         DB::rollBack();
        DB::commit();

        return response()->json(["success" => true, "message" => 'Language preferences updated.']);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user)
    {
        $data = $this->validate($request, [
            'languages',
        ]);


        DB::beginTransaction();

        // get rid of all the current values for the user

        UserLanguage::where([
            'user_id' => $user->id
        ])->delete();

        // insert all new language values for current user

        // we do this in case we want to filter this before continuing...
        $filtered = $this->filter($data);
        $languages = $filtered['languages'];

        $inserts = [];

        foreach($languages as $languageId) {
            $inserts[] = [
                "language_id" => $languageId,
                "user_id" => $this->loggedInUser->id
            ];
        }

        if (count($inserts)) {
            UserLanguage::insert($inserts);
        }

//         DB::rollBack();
        DB::commit();

        return response()->json(["success" => true, "message" => 'Language preferences updated.']);
    }

}
