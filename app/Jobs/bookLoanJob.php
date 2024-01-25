<?php

namespace App\Jobs;

use App\Models\BookLoan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class bookLoanJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private $request){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            BookLoan::create($this->request);
        } catch (\Exception $exception) {
            // Save Erorr In Laravel Log File
            Log::error('error in BookLoan method in BookLoanService: ' . $exception->getMessage() . " \n" . $exception);
        }
    }
}