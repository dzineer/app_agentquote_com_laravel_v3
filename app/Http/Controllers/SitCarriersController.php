<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use App\Models\CarriersTermlife;
use App\Models\CategoriesInsurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class SitCarriersController
 * @package App\Http\Controllers
 */
class SitCarriersController extends BackendController
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

		$sit_termLife = CategoriesInsurance::getCarriers($user->id,2);

		// dd($carriers_termLife);

		return view('sit-carriers', ['carriers' => $sit_termLife ] );
	}

	public function usettings(Request $request) {
		// dd($request->all());
		$user_id = Auth::user()->id;
		$settings = array();
		$settings['carriers'] = array();

		$form = $request->all();

		foreach( $form as $field_name => $field_value ) {

			if ( strstr($field_name, "hidden_carrier__" ) != false ) {
				$arr = explode('__', $field_name );
				$id = $arr[1];
				$key = 'carrier_' . $id;
				// echo "<br>arr: <br>" . print_r( $arr, true );
				$settings['carriers'][ $key ]['hidden'] = $field_value;
			}
			else if ( strstr($field_name, "carrier_" ) != false ) {
				$settings['carriers'][ $field_name ]['value'] = $field_value;
			}
			else if( strstr($field_name, "hidden_product__" ) != false ) {
				$arr = explode('__', $field_name );
				$id = $arr[1];
				$key = 'product_' . $id;
				// echo "<br>arr: <br>" . print_r( $arr, true );
				$settings['products'][ $key ]['hidden'] = $field_value;
			}
			else if( strstr($field_name, "product_" ) != false ) {
				$settings['products'][ $field_name ]['value'] = $field_value;
			}
		}

		// dd($settings);

		foreach( $settings['carriers'] as $carrier ) {
			if( $carrier['hidden'] == 0 ) { // not set before
				if ( isset( $carrier['value'] ) ) { // should we set this?
					// echo "<br>Adding Carrier: " . print_r($carrier,true) . " for user_id: " . $user_id; exit;
					// exit;
					// $this->model->insertCarrier( $user->id, $carrier['value'] );
					CategoriesInsurance::addCarrier($user_id, $carrier["value"], 2);
				}

			}
			else if ( isset( $carrier['hidden'] ) && $carrier['hidden'] != 0 ) { // we already have this carrier
				if ( ! isset( $carrier['value'] ) ) { // do we still have this carrier
					// echo "<br>Removing Carrier: " . print_r($carrier,true) . " for user_id: " . $user_id;
					// exit;
					// $this->model->removeCarrier( $user->id, $carrier['hidden'] );
					// $this->model->removeCarrierProducts( $user->id, $carrier['hidden'] );
					CategoriesInsurance::removeCarrier($user_id, $carrier["hidden"], 2);
				}
			}
		}

		$carriers_sit = CategoriesInsurance::getCarriers($user_id,2);

		// dd($carriers_termLife);

		$message = 'Carriers updated';

		return view('sit-carriers', ['carriers' => $carriers_sit, 'message' => $message ] );

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
