<?php

namespace App\Http\Controllers;

use App\Jobs\CompileAffiliateReports;
use App\Jobs\CompileLoginLogoutReports;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Validator;

class ReportsController extends Controller // BackendController
{
    public function index(Request $request) {

        $report1 = new CompileAffiliateReports();
        $this->dispatch($report1);

        $report2 = new CompileLoginLogoutReports();
        $this->dispatch($report2);
    }
}
