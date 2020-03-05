<?php

namespace App\Http\Controllers;

// use App\Models\ProfileUser;
use App\Models\SupportVideo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class VideosController extends BackendController
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('videos' );
    }

    public function videos() {
	    $videos = SupportVideo::all();

	    /*    videos: [
						{ "header": "General Setup", "url": "https://player.vimeo.com/video/317978590", className: "mt-4" },
						{ "header": "Product Input", "url": "https://player.vimeo.com/video/317978934", className: "mt-4" },
						{ "header": "FE", "url": "https://player.vimeo.com/video/317984214", className: "mt-4" },
						{ "header": "SI Term", "url": "https://player.vimeo.com/video/317985649", className: "mt-4" },
						{ "header": "Term Life", "url": "https://player.vimeo.com/video/317986659", className: "mt-4" },
					]
		 */

	    $tmpVideos = array();

	    foreach($videos as $video) {
		    $tmpObj = new \stdClass();
		    $tmpObj->header = $video->caption;
		    $tmpObj->thumbnail = $video->image;
		    $tmpObj->url = $video->url;
		    $tmpObj->className = "mt-4";
		    $tmpObj->preferred = $video->preferred;
		    $tmpVideos[] = $tmpObj;
	    }

	    return response()->json([ 'videos' => $tmpVideos ], 200, [], JSON_UNESCAPED_UNICODE);
    }

}
