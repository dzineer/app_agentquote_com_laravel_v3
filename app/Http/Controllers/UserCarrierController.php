<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use App\Models\CategoriesInsurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCarrierController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
	    $carriers = Carrier::all();

/*	    $categories = new \stdClass();
	    $categories->termlife = new \stdClass();
	    $categories->sit = new \stdClass();
	    $categories->siwl = new \stdClass();*/

	    // get all carriers
	    // get all carrier categories
	    // get all user carriers-termlife
	    // get all user carriers-sit
	    // get all user carriers-siwl
	    // create compound object

	    $new_carriers = [];
	    $new_categories = [];
	    $categories = CategoriesInsurance::all();
	    foreach($categories as $category) {
		    $new_categories[] = array("name" => $category->name, "category_id" => $carriers->id);
	    }

	    dd($new_categories);

/*	    foreach($carriers as $carrier) {
			$carrier->categories;
		    $new_carriers[]
	    }*/
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
