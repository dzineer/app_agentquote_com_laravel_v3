<?php

namespace App\Console\Commands;

use App\Models\LoginsLog;
use App\Models\QuoteUser;
use Illuminate\Console\Command;

class DzineerCleanReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dzineer:clear-every-three-months-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear reports greater than three months.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->cleanLoginReports();
        $this->cleanUserQuotesReports();

        return true;
    }

    private function cleanLoginReports(): void
    {
        try {
            $formatted = $this->getExpiresDate();
            LoginsLog::where('created_at', '<=', $formatted)->delete();
        } catch (\Exception $e) {

        }
    }

    private function cleanUserQuotesReports(): void
    {
        try {
            $formatted = $this->getExpiresDate();
            QuoteUser::where('created_at', '<=', $formatted)->delete();
        } catch (\Exception $e) {

        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function getExpiresDate(): string
    {
        $date = new \DateTime;
        $date->modify('-90 days');
        $formatted = $date->format('Y-m-d H:i:s');

        return $formatted;
    }
}
