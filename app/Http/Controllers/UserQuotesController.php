<?php

namespace App\Http\Controllers;

use App\UserQuote;
use Illuminate\Http\Request;

class UserQuotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    return view('my-quotes');
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
     * @param  \App\UserQuote  $userQuote
     * @return \Illuminate\Http\Response
     */
    public function show(UserQuote $userQuote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserQuote  $userQuote
     * @return \Illuminate\Http\Response
     */
    public function edit(UserQuote $userQuote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserQuote  $userQuote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserQuote $userQuote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserQuote  $userQuote
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserQuote $userQuote)
    {
        //
    }
}
