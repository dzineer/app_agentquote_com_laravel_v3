<?php

namespace App\Traits;

use App\Models\Affiliate;
use App\Models\QuoteUsers;

trait QuotesPagination
{
    protected function getAffiliateQuotes(Affiliate $affiliate, $user, $sortBy = 'id', $order = 'asc')
    {
        $quotes = null;

        if ($sortBy === 'id') {
            $quotes = QuoteUsers::where('affiliate_id', '=', $affiliate->id)//  ->where('created_at', '>=', \Carbon\Carbon::today())
                ->orderBy('created_at', 'desc')->paginate(intval(config('agentquote.agents.reports.pagination.items')));
        } else {

            $quotes = QuoteUsers::where('affiliate_id', '=', $affiliate->id)// ->where('created_at', '>=', \Carbon\Carbon::today())
                ->orderBy($sortBy, $order)->paginate(intval(config('agentquote.agents.reports.pagination.items')));
        }

        // dd($quotes);

        $quotes_with_pagination = json_decode(json_encode($quotes));

        foreach ($quotes_with_pagination->data as $key => $quote) {
            $quote->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($quote->created_at))->isoFormat('LLL');
            $quotes_with_pagination->data[$key] = $quote;
        }

        $quotes = $quotes_with_pagination->data;
        unset($quotes_with_pagination->data);

        return ["quotes" => $quotes, "pagination" => $quotes_with_pagination];
    }

    protected function getAllRecentQuotes($sortBy = 'id', $order = 'asc')
    {

        $quotes = null;

        if ($sortBy === 'id') {

            $quotes = QuoteUsers::paginate(intval(config('agentquote.agents.reports.pagination.items')));
        } else {

            $quotes = QuoteUsers::orderBy($sortBy, $order)->paginate(intval(config('agentquote.agents.reports.pagination.items')));
        }

        $quotes_with_pagination = json_decode(json_encode($quotes));

        foreach ($quotes_with_pagination->data as $key => $quote) {
            $quote->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($quote->created_at))->isoFormat('LLL');
            $quotes_with_pagination->data[$key] = $quote;
        }

        $quotes = $quotes_with_pagination->data;
        unset($quotes_with_pagination->data);

        return ["quotes" => $quotes, "pagination" => $quotes_with_pagination];
    }

    protected function getRecentQuotes(Affiliate $affiliate, $user, $sortBy = 'id', $order = 'asc')
    {
        $quotes = null;

/*        echo json_encode([
            "sortBy" => "$sortBy",
            "order" => "$order",
        ]); exit;*/

        if ($sortBy === 'id') {
            $quotes = QuoteUsers::where('affiliate_id', '=', $affiliate->id)
                ->where('user_id', '=', $user->id)
                // ->where('created_at', '>=', \Carbon\Carbon::today())
                ->orderBy('created_at', 'desc')
                ->paginate(intval(config('agentquote.agents.reports.pagination.items')));
        } else {

            $quotes = QuoteUsers::where('affiliate_id', '=', $affiliate->id)
                ->where('user_id', '=', $user->id)
                // ->where('created_at', '>=', \Carbon\Carbon::today())
                ->orderBy($sortBy, $order)
                ->paginate(intval(config('agentquote.agents.reports.pagination.items')));
        }

        $quotes_with_pagination = json_decode(json_encode($quotes));

        foreach ($quotes_with_pagination->data as $key => $quote) {
           // $quote->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($user->created_at))->diffForHumans();
            $quote->created_at = \Carbon\Carbon::createFromTimestamp(strtotime($quote->created_at))->isoFormat('LLL');
            $quotes_with_pagination->data[$key] = $quote;
        }

        $quotes = $quotes_with_pagination->data;
        unset($quotes_with_pagination->data);

        // dd(["quotes" => $quotes, "pagination" => $quotes_with_pagination]);

        return ["quotes" => $quotes, "pagination" => $quotes_with_pagination];
    }

    protected function getAllAffiliates()
    {

        $affiliates = Affiliate::all();

        /*        $quotes = QuoteUsers::where('created_at', '>=', \Carbon\Carbon::today())->orderBy('created_at', 'DESC')
                    ->paginate(
                        intval(config('agentquote.agents.reports.pagination.items'))
                    );*/

        return $affiliates;
    }

    protected function genPages($pagination)
    {
        $pages = [];

        $params = http_build_query(request()->except('page'));

        for ($page = 1; $page <= $pagination->last_page; $page++) {
            // request()->except('page')
            if (strlen($params)) {
                $pages[$page] = $pagination->path.'?'.$params.'&'.'page='.$page;
            } else {
                $pages[$page] = $pagination->path.'?'.'page='.$page;
            }
        }

        // dd($pages);

        return $pages;
    }
}