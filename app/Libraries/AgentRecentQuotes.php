<?php

namespace App\Libraries;

use App\Traits\QuotesPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AgentRecentQuotes
{
    public const PRODUCT_USER = 5;

    public const ADMIN_USER = 3;

    public const MANAGER_USER = 4;

    use QuotesPagination;

    /**
     * @param \Illuminate\Http\Request $request
     * @param $affiliate
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $user
     * @return \Illuminate\Contracts\View\View
     */
    public function generateQuotes(
        Request $request,
        $affiliate,
        ?\Illuminate\Contracts\Auth\Authenticatable $user
    ): \Illuminate\Contracts\View\View {

        $sorts = [
            'age', 'state', 'month', 'day', 'created_at', 'year', 'gender', 'term', 'benefit', 'category'
        ];

        $orders = [
            'asc', 'desc'
        ];

        if ($request->has('sortby') && $request->has('order')) {
            $sortBy = $request->input('sortby');

            if ($sortBy === 'date') {
                $sortBy = 'created_at';
            }

            if (in_array($sortBy, $sorts) && in_array($request->input('order'), $orders)) {
                $quotes_with_pagination = $this->getRecentQuotes($affiliate, $user, $sortBy, $request->input('order'));
            } else {
                $quotes_with_pagination = $this->getRecentQuotes($affiliate, $user, $sortBy = 'id', $order = 'desc');
            }
        } else {
            $quotes_with_pagination = $this->getRecentQuotes($affiliate, $user, $sortBy = 'id', $order = 'desc');
            // dd($quotes_with_pagination);
        }

        $pagination = $quotes_with_pagination['pagination'];

        $pagination->pages = new \stdClass();
        $pagination->pages = $this->genPages($pagination);

        // dd($quotes_with_pagination['quotes']);

/*       echo json_encode(  [
            "user" => $user,
            "quotes" => $quotes_with_pagination['quotes'],
            "pagination" => json_encode($pagination),
            "affiliate_id" => $affiliate->id
        ] ); exit;*/

        return View::make('reports.quotes-report', [
            "user" => $user,
            "quotes" => json_encode($quotes_with_pagination['quotes']),
            "pagination" => json_encode($pagination),
            "affiliate_id" => $affiliate->id
        ]);

        return view('reports.quotes-report', []);
    }
}