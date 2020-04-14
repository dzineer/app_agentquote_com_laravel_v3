<?php

namespace App\Http\Controllers;

use App\Models\UserLanguage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Facades\AQLog;
use Illuminate\Support\Facades\DB;

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

	  //  dnd($this->loggedInUser);

        $languages = UserLanguage::languages($this->loggedInUser->id);

        $data = [
            "user" => $this->loggedInUser,
            "languages" => $languages,
        ];

        // dd($data);

		return view('profile.languages.index', $data)->render();
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
