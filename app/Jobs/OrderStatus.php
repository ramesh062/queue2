<?php

namespace App\Jobs;

use App\Mail\OrderStatusEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    public $timeout = 120;
    // public $connection = 'database';
    // public $queue="processing";
    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try
        {
            Log::info("send email");
            Mail::to(env('EMAIL'), env('NAME'))->send(new OrderStatusEmail($this->data));
        }
        catch(\Exception $e)
        {
            Log::info($e->getMessage());
        }
    }
    
    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
    */
    public function failed(Exception $exception)
    {
        // Send user notification of failure, etc...
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return \DateTime
    */

    public function retryUntil()
    {
        return now()->addSeconds(5);
    }
}
