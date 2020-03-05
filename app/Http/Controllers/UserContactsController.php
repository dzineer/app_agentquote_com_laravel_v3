<?php

namespace App\Http\Controllers;

use App\Models\ContactUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $user = Auth::user();
	    $contacts = ContactUser::find($user->id)->all();
	    return view('my-contacts', ['contacts' => $contacts]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserContact  $userContact
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUser $userContact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserContact  $userContact
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUser $userContact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserContact  $userContact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactUser $userContact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserContact  $userContact
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUser $userContact)
    {
        //
    }
}
