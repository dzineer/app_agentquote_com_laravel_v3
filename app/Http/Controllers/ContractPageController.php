<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractPageController extends Controller
{
    public function index() {

    }

    public function store() {

    }

    public function show() {

    }

    public function create() {

        $page = [];
        $page["header"] =  'Contract Link';

        $labels = [
           'save_button_text' => 'Save',
           'contract_page_label' => 'Contract Page Link'
        ];

        $user = Auth::user();

        return view('affiliate.contract_page', compact('user', 'page', 'labels'));
    }
}
