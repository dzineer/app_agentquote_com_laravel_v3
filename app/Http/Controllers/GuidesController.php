<?php

namespace App\Http\Controllers;

// use App\Models\ProfileUser;
use App\Blueprints\CarrierBlueprint;
use App\Blueprints\CategoryBlueprint;
use App\Blueprints\GuideBlueprint;
use App\Factories\CarrierFactory;
use App\Factories\CategoryFactory;
use App\Factories\GuideFactory;
use App\Models\Carrier;
use App\Models\CarrierGuide;
use App\Models\CarrierPopular;
use App\Models\CategoriesInsurance;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class GuidesController extends BackendController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	parent::__construct();
        $this->middleware('auth');
    }

    private function getCategories( $carrier ) {
    	$cats = $carrier->categories;
    	return $cats;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function guides()
    {
    	$carriers = array();
    	$popular = array();

	    $guides = CarrierGuide::all();

	    // dd($guides);

	    foreach($guides as $guide) {
	    	$company = Carrier::where("company_id", '=', $guide->company_id)->first();
		    $CarrierPopularObj = CarrierPopular::where('company_id', "=", $guide->company_id)->first();

		    $isPopular = ($CarrierPopularObj !== null) ? 1 : 0;

	    	$category = CategoriesInsurance::where("category_id", "=", $guide->category_id)->first();

	    	// check if we have a category
		    // if so, use that category
		    // else

	    	$guideObj = new \stdClass();
	    	$guideObj->name = $guide->name;
	    	$guideObj->url = $guide->url;
	    	$guideObj->preferred = $guide->preferred;
	    	$guideObj->guide_title = $guide->guide_title !== NULL ? $guide->guide_title : '';

		    $popular[ $company->name ] = $isPopular;
		    $carriers[ $company->name ][ $category->name ][] = $guideObj;
	    }

	    $cleanedGuides = array();

	   // dd($carriers);

	    foreach($carriers as $carrierName => $carrier_categories) {
	    	$carrierObj = new \stdClass();
	    	$carrierObj->name = $carrierName;
	    	$carrierObj->popular = $popular[ $carrierName ];

	    	$categories = array();

		   // dnd($carrier_categories);

	    	foreach($carrier_categories as $cat => $guides) {
			   // dd($guides);
	    		$catObj = new \stdClass();
	    		$catObj->name = $cat;
			    // $catObj->guides = array();
			   // foreach($guides )

			    $catObj->guides = $guides;
			    $categories[] = $catObj;
		    }

		    $carrierObj->categories = $categories;
	    	$cleanedGuides[] = $carrierObj;
	    }

	   // dd($cleanedGuides);

	    return response()->json([ 'guides' => $cleanedGuides ], 200, [], JSON_UNESCAPED_UNICODE);

	    $carriers = array();

	    $carriers[] = CarrierFactory::Make(

			new CarrierBlueprint(
				"Banner Life Insurance Company",
				[
					CategoryFactory::Make(
						new CategoryBlueprint(
							"Underwritten Term", [
								GuideFactory::Make(
									new GuideBlueprint("Guide1", "https://underwritten1")
								),
								GuideFactory::Make(
									new GuideBlueprint("Guide2", "https://underwritten2")
								)
							]
						)
					),
					CategoryFactory::Make(
						new CategoryBlueprint(
							"Simplified Issue Term", [
								GuideFactory::Make(
									new GuideBlueprint("Guide3", "https://sit1")
								),
								GuideFactory::Make(
									new GuideBlueprint("Guide4", "https://sit2")
								)
							]
						)
					),
					CategoryFactory::Make(
						new CategoryBlueprint(
							"FE", [
								GuideFactory::Make(
									new GuideBlueprint("Guide5", "https://fe1")
								),
								GuideFactory::Make(
									new GuideBlueprint("Guide6", "https://fe2")
								)
							]
						)
					)
				]

			)
		);

	    $carriers[] = CarrierFactory::Make(

		    new CarrierBlueprint(
			    "American General Life Insurance Company",
			    [
				    CategoryFactory::Make(
					    new CategoryBlueprint(
						    "Underwritten Term", [
							    GuideFactory::Make(
								    new GuideBlueprint("Guide1", "https://underwritten3")
							    ),
							    GuideFactory::Make(
								    new GuideBlueprint("Guide2", "https://underwritten4")
							    )
						    ]
					    )
				    ),
				    CategoryFactory::Make(
					    new CategoryBlueprint(
						    "Simplified Issue Term", [
							    GuideFactory::Make(
								    new GuideBlueprint("Guide3", "https://sit3")
							    ),
							    GuideFactory::Make(
								    new GuideBlueprint("Guide4", "https://sit4")
							    )
						    ]
					    )
				    ),
				    CategoryFactory::Make(
					    new CategoryBlueprint(
						    "FE", [
							    GuideFactory::Make(
								    new GuideBlueprint("Guide5", "https://fe3")
							    ),
							    GuideFactory::Make(
								    new GuideBlueprint("Guide6", "https://fe4")
							    )
						    ]
					    )
				    )
			    ]

		    )
	    );

	    $carriers[] = CarrierFactory::Make(

		    new CarrierBlueprint(
			    "Transamerica Life Insurance Company",
			    [
				    CategoryFactory::Make(
					    new CategoryBlueprint(
						    "Underwritten Term", [
							    GuideFactory::Make(
								    new GuideBlueprint("Guide7", "https://underwritten5")
							    ),
							    GuideFactory::Make(
								    new GuideBlueprint("Guide8", "https://underwritten6")
							    )
						    ]
					    )
				    ),
				    CategoryFactory::Make(
					    new CategoryBlueprint(
						    "Simplified Issue Term", [
							    GuideFactory::Make(
								    new GuideBlueprint("Guide9", "https://sit5")
							    ),
							    GuideFactory::Make(
								    new GuideBlueprint("Guide10", "https://sit6")
							    )
						    ]
					    )
				    ),
				    CategoryFactory::Make(
					    new CategoryBlueprint(
						    "FE", [
							    GuideFactory::Make(
								    new GuideBlueprint("Guide11", "https://fe5")
							    ),
							    GuideFactory::Make(
								    new GuideBlueprint("Guide12", "https://fe6")
							    )
						    ]
					    )
				    )
			    ]

		    )
	    );

	    return response()->json([ 'guides' => $carriers ], 200, [], JSON_UNESCAPED_UNICODE);
    }

	public function index()
	{
		return view('guides');

	}
}
