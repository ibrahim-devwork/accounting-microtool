<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConvertOfxToCsvJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $process_id;
    /**
     * Create a new job instance.
     */
    public function __construct($process_id)
    {
        $this->process_id = $process_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // 
    }
}
