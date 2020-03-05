<?php

namespace App\Jobs;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CompileAffiliateReports implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * Create a new job instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function handle(Request $request)
    {
        var_dump("Compiling the affiliate reports from the CompileAffiliateReports class");

       // $report = new CompileLoginLogoutReports();
       // $this->dispatch($report);
    }
}
