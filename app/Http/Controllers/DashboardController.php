<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\AffiliateGroupUser;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
	public function __construct()
	{
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	exit;
	  /*  View::composer('*', function ($view) {
		    $user          = Auth::user();
		    $profile       = ProfileUser::where('user_id', '=', $user->id)->first();
		    $view->with('user', $user);
		    $view->with('profile', $profile);
	    }); */
	    $profile = [];
	    $user = Auth::user();

	    dd($user);

	    return view('dashboard', ['user_default_state '=> 'false', 'user' => $user, 'profile' => $profile]);
    }

	public function super()
	{
        $user = Auth::user();
		return view('dashboards.super', compact('user'));
	}

	public function affiliate()
	{
        $user = Auth::user();
		return view('dashboards.affiliate', compact('user'));
	}
	public function admin()
	{
        $user = Auth::user();
		return view('dashboards.admin', compact('user'));
	}

	public function manager()
	{
        $user = Auth::user();
		return view('dashboards.manager', compact('user'));
	}

	public function user()
	{
        $user = Auth::user();
		return view('dashboards.user', compact('user'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
