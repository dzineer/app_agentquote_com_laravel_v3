<?php

namespace App\Http\Controllers;

use App\Libraries\TermlifeQuoter;
use App\Models\Carrier;
use App\Models\CarriersTermlife;
use App\Models\CategoriesInsurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



/**
 * Class TermlifeCarriersController
 * @package App\Http\Controllers
 */
class TermlifeCarriersController extends BackendController
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

	    //dd($new_categories);
        return view('carriers');
    }

	public function settings(Request $request)
	{
		$request->user()->authorizeRoles(['user']);
		$user = Auth::user();
		$carriers_termLife = CategoriesInsurance::getCarriers($user->id,1);

		return view('termlife-carriers', ['carriers' => $carriers_termLife ] );
	}

	public function usettings(Request $request) {

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
				$settings['products'][ $key ]['hidden'] = $field_value;
			}
			else if( strstr($field_name, "product_" ) != false ) {
				$settings['products'][ $field_name ]['value'] = $field_value;
			}
		}

		foreach( $settings['carriers'] as $carrier ) {
			if( $carrier['hidden'] == 0 ) { // not set before
				if ( isset( $carrier['value'] ) ) { // should we set this?
					CategoriesInsurance::addCarrier($user_id, $carrier["value"], 1);
				}

			}
			else if ( isset( $carrier['hidden'] ) && $carrier['hidden'] != 0 ) { // we already have this carrier
				if ( ! isset( $carrier['value'] ) ) { // do we still have this carrier
					CategoriesInsurance::removeCarrier($user_id, $carrier["hidden"], 1);
				}
			}
		}

		$carriers_termLife = CategoriesInsurance::getCarriers($user_id,1);

		$message = 'Carriers updated';

		return view('termlife-carriers', ['carriers' => $carriers_termLife, 'message' => $message ] );

	}

	public function quote() {
		$quoter = new TermlifeQuoter();
		$quoter->getQuote(array());
	}
}
