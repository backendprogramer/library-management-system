<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class RunJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Job';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = \Carbon\Carbon::now()->timestamp;
        $unrunedJobs = DB::table('jobs')->where('created_at','<',$now-15)->count();
        if ($unrunedJobs > 0) {
            Artisan::call('queue:restart');
            Artisan::call('queue:work');
        }
    }
}