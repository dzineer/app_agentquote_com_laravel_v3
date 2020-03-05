<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CompileLoginLogoutReports implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $reportId;
    private $type;

    /**
     * Create a new job instance.
     *
     ß*/
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
        var_dump("Compiling the {$request->input('type')} report {$request->input('reportId')} from the CompileLoginLogoutReports class");
    }
}
