<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\AffiliateGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AffiliateGroupsController extends Controller
{
    public function index() {
        $groups = [];
        $user = Auth::user();

        if ($user->is_super()) {

            $page = [];
            $page["header"] =  'Affiliate Groups';

            $groups = AffiliateGroup::all();

            $affiliate_id = 0;

            $labels = [
                'groups_label' => 'Groups',
            ];

            return view('super.groups', compact('user', 'affiliate_id', 'groups', 'page', 'labels'));

        }
        else if ($user->is_affiliate()) {

            $page = [];
            $page["header"] =  'Affiliate Groups';

            $affiliate = Affiliate::find($user->affiliate_id);
            $groups = AffiliateGroup::where('affiliate_id', '=', $affiliate->id)->get();

            $affiliate_id = $affiliate->id;

            // $groups = json_encode($aff_groups);

            // dd($aff_groups);

            $labels = [
                'groups_label' => 'Groups',
            ];

            return view('affiliate.groups', compact('user', 'affiliate_id', 'groups', 'page', 'labels'));

        }
        else if ($user->is_admin()) {

            $page = [];
            $page["header"] =  'Affiliate Groups';

            $affiliate = Affiliate::find($user->affiliate_id);
            $groups = AffiliateGroup::where('affiliate_id', '=', $affiliate->id)->get();

            $affiliate_id = $affiliate->id;

            // $groups = json_encode($aff_groups);

            // dd($aff_groups);

            $labels = [
                'groups_label' => 'Groups',
            ];

            return view('affiliate.groups', compact('user', 'affiliate_id', 'groups', 'page', 'labels'));

        }


    }

    public function show() {
        $groups = [];
        $user = Auth::user();

        // dd($user);

        $page = [];
        $page["header"] =  'Affiliate Groups';

        $agentQuoteGroup = new \stdClass();
        $agentQuoteGroup->id = 1;
        $agentQuoteGroup->selected = false;
        $agentQuoteGroup->name = "Agent Quote";

        $agentQuoterGroup = new \stdClass();
        $agentQuoterGroup->id = 2;
        $agentQuoterGroup->selected = true;
        $agentQuoterGroup->name = "Agent Quoter";

        $affiliate = Affiliate::where('user_id', $user->id);

        dd($affiliate);


        $groups = [
            $agentQuoteGroup,
            $agentQuoterGroup
        ];

        $labels = [
            'groups_label' => 'Groups',
            'save_button_text' => 'Save'
        ];

        return view('affiliate.groups', compact('user', 'groups', 'page', 'labels'));
    }

    public function store() {

    }

    public function create() {
        $groups = [];
        $user = Auth::user();

        $page = [];
        $page["header"] =  'New Group';

        $labels = [
            'groups_label' => 'Group',
            'save_button_text' => 'Save'
        ];

        return view('affiliate.group_new', compact('user', 'page', 'labels'));
    }

    public function delete() {

    }
}
