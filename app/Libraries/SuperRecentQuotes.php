<?php

namespace App\Libraries;

use App\Traits\QuotesPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SuperRecentQuotes
{
    use QuotesPagination;

    /**
     * @param \Illuminate\Http\Request $request
     * @param $affiliate
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $user
     * @return \Illuminate\Contracts\View\View
     */
    public function generateQuotes(
        Request $request,
        ?\Illuminate\Contracts\Auth\Authenticatable $user
    ): \Illuminate\Contracts\View\View {

        $sorts = [
            'age', 'state', 'month', 'day', 'year', 'gender', 'term', 'benefit', 'category'
        ];

        $orders = [
            'asc', 'desc'
        ];

        if ($request->has('sortby') && $request->has('order')) {
            $sortBy = $request->input('sortby');

            if (in_array($sortBy, $sorts) && in_array($request->input('order'), $orders)) {
                $quotes_with_pagination = $this->getAllRecentQuotes($sortBy, $request->input('order'));
            } else {
                $quotes_with_pagination = $this->getAllRecentQuotes($sortBy = 'id', $order = 'asc');
            }
        } else {
            $quotes_with_pagination = $this->getAllRecentQuotes($sortBy = 'id', $order = 'asc');
        }

        // dd($quotes_with_pagination);

        $pagination = $quotes_with_pagination['pagination'];

        $pagination->pages = new \stdClass();
        $pagination->pages = $this->genPages($pagination);

        return View::make('reports.quotes-report', [
            "user" => $user,
            "quotes" => json_encode($quotes_with_pagination['quotes']),
            "pagination" => json_encode($pagination),
            "affiliate_id" => 0
        ]);
    }
}