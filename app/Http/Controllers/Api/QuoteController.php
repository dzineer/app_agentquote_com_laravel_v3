<?php

namespace App\Http\Controllers\Api;

use App\Models\Affiliate;
use App\Models\QuoteUser;
use App\Models\QuoteUsers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    private function getAllRecentQuotes($sortBy='id', $order = 'asc')
    {

        $quotes = null;

        if ($sortBy === 'id') {

            $quotes = QuoteUsers::paginate(
                intval(config('agentquote.agents.reports.pagination.items'))
            );

        } else {

            $quotes = QuoteUsers::orderBy($sortBy, $order)->paginate(
                intval(config('agentquote.agents.reports.pagination.items'))
            );

        }

        return $quotes;
    }

    private function getRecentQuotes(Affiliate $affiliate, $user, $sortBy='id', $order = 'asc')
    {
        $quotes = null;

        if ($sortBy === 'id') {

            $quotes = QuoteUsers::where('affiliate_id', '=', $affiliate->id)
                ->where('user_id', '=', $user->id)
                ->orderBy('id', 'asc')
                ->  paginate(
                    intval(config('agentquote.agents.reports.pagination.items'))
                )->setPath(route('recent.quotes'));

        } else {

            $quotes = QuoteUsers::where('affiliate_id', '=', $affiliate->id)
                ->where('user_id', '=', $user->id)
                ->orderBy($sortBy, $order)
                ->paginate(
                    intval(config('agentquote.agents.reports.pagination.items'))
                )->setPath(route('recent.quotes'));
        }

        // echo json_encode($quotes); exit;

        $quotes_with_pagination = json_decode(json_encode($quotes));

        // echo json_encode(["quotes" => $quotes, "pagination" => $quotes ]); exit;

 /*       foreach($quotes_with_pagination->data as $key => $quote) {
            $quote->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($quote->created_at))->diffForHumans();
            $quotes_with_pagination->data[$key] = $quote;
        }*/

        $quotes = $quotes_with_pagination->data;

        if(!$quotes) {
            $quotes = [];
        } else {
            unset( $quotes_with_pagination->data );
        }
        // echo json_encode(["quotes" => $quotes, "pagination" => $quotes ]); exit;
        return ["quotes" => $quotes, "pagination" => $quotes_with_pagination ];
    }

    private function genPages($pagination) {
        $pages = [];

        $params = http_build_query(request()->except('page','_method', 'affiliate_id', 'user_id', 'quote_id'));

        for ($page = 1; $page <= $pagination->last_page; $page++) {
            // request()->except('page')
            if (strlen($params)) {
                $pages[$page] = $pagination->path.'?'.$params.'&'.'page='.$page;
            } else {
                $pages[$page] = $pagination->path . '?'.'page='.$page;
            }
        }

        // dd($pages);

        return $pages;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\JsonResponse|\Illuminate\Http\Request|string
     * @throws \Illuminate\Validation\ValidationException
     */
    public function destroy(Request $request)
    {

        $data = $this->validate($request, [
            'affiliate_id' => 'required',
            'user_id' => 'required',
            'quote_id' => 'required'
        ]);

/*        return response()->json([
            "success" => false,
            "data" => $data,
            "message" => "your data back"
        ]);*/

        $sorts = [
            'age', 'state', 'month', 'day', 'year', 'gender', 'term', 'benefit', 'category'
        ];

        $orders = [
            'asc', 'desc'
        ];

        $user = User::where('id', '=', $request->input('user_id'))->first();

/*        return response()->json([
            "success" => false,
            "data" => print_r($user, true),
            "message" => "your data back"
        ]);*/

        QuoteUser::where("id", "=", $data['quote_id'])->delete();

        $pages = [];

        if ($user) {

            // $quote_user->delete();
            $affiliate = Affiliate::find($user->affiliate_id);

            if ($affiliate) {

                if (request()->has('sortby') && request()->has('order')) {
                    $sortBy = request()->input('sortby');

                    if (in_array($sortBy,  $sorts) &&
                        in_array(request()->input('order'), $orders)
                    ) {
                        $quotes_with_pagination = $this->getRecentQuotes($affiliate, $user, $sortBy, request()->input('order'));
                    } else {
                        $quotes_with_pagination = $this->getRecentQuotes($affiliate, $user, $sortBy='id', $order = 'asc');
                    }

                    $pagination = $quotes_with_pagination['pagination'];
                    $pagination->pages = new \stdClass();
                    $pagination->pages = $this->genPages($pagination);

                    return response()->json(  ["success" => true, "message" => "Quote deleted successfully.", "quotes" => $quotes_with_pagination['quotes'], "pagination" => $pagination]);

                } else {

                    $quotes_with_pagination = $this->getRecentQuotes($affiliate, $user, $sortBy='id', $order = 'asc');
                    $pagination = $quotes_with_pagination['pagination'];
                    $pagination->pages = new \stdClass();
                    $pagination->pages = $this->genPages($pagination);

                    return response()->json(  ["success" => true, "message" => "Quote deleted successfully.", "quotes" => $quotes_with_pagination['quotes'], "pagination" => $pagination]);
                }

            } else {
                return request(["success" => false, "message" => "Quote was not deleted."]);
            }
        }
        else {
            return request(["success" => false, "message" => "Quote was not deleted."]);
        }
    }
}
