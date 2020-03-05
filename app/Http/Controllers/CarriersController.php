<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use App\Models\CarriersTermlife;
use App\Models\CategoriesInsurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class CarriersController
 * @package App\Http\Controllers
 */
class CarriersController extends BackendController
{

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index(Request $request)
    {
    	$request->user()->authorizeRoles(['manager']);
	    $user = Auth::user();
	    $carriers = Carrier::all();


	    $new_categories = [];
	    $categories = CategoriesInsurance::all();
	    foreach($categories as $category) {
		    $new_categories[] = array("name" => $category->name, "category_id" => $carriers->id);
	    }

	    dd($new_categories);
        return view('carriers');
    }

	public function settings(Request $request)
	{
		$request->user()->authorizeRoles(['user']);
		$user = Auth::user();

		$carriers_termLife = CategoriesInsurance::getCarriers($user->id,1);

		// dd($carriers_termLife);

		return view('termlife-carriers', ['carriers' => $carriers_termLife ] );
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
