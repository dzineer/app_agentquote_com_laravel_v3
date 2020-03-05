<?php

namespace App\Http\Controllers;

use App\Libraries\MailBodyBuilder;
use App\Mail\NewQuoteReceivedMail;
use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use App\Models\GroupUser;
use App\Models\UserSubdomain;
use App\Models\MessageUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class FilesManagerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->is_super()) {
            return view('file-manager.create', []);
        }

   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
/*        return response()->json([
            "success" => false,
            "message" => $request->hasFile('file')
        ]);*/

        $user = auth()->user();

        if ( ! $user->is_super() ) {

            return response()->json([
                "success" => false,
                "message" => "File not uploaded successfully."
            ], 505);
        }

        $data = $this->validate($request, [
            'file' => 'required',
        ]);

        if ($request->hasFile('file')) {
            $moveTo = public_path() . '/images/';
            $request->file('file')->move($moveTo,$request->file('file')->getClientOriginalName());
            $data['image_url'] = '/images/' . $request->file('file')->getClientOriginalName();
            return response()->json([
              //"success" => true,
              // "message" => "File uploaded successfully.",
               "location" =>$data['image_url']
            ]);
        }

        return response()->json([
            "success" => false,
            "message" => "File not uploaded successfully."
        ], 505);
    }

}
