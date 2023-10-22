<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Models\CsvToOfxConversion;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeleteOldProcessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is to delete the old process that is more than 3 days old';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {

            $threeDaysAgo = now()->subDays(3);
            $processList  = CsvToOfxConversion::where('updated_at', '<', $threeDaysAgo)->get();
            foreach($processList as $process) {
                Helper::deleteFileIfExists('files/' . $process->ofx_file_name);
                Helper::deleteFileIfExists('files/' . $process->csv_file_name);
                $process->delete();
            }
            echo "Delete old process successfully.";
        } catch(\Exception $error) {
            echo "Error : Something wrong !";
            Log::error('DeleteOldProcessCommand - (handle) : ' . $error->getMessage());
        }
        
    }   
}
