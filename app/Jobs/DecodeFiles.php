<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DecodeFiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file_data = array();

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path, $code)
    {
        $this->file_data[0] = $path;
        $this->file_data[1] = $code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = Storage::disk('local')->get($this->file_data[0]);
        if ($this->file_data[1] == "base64")
            $file = base64_decode($file);
        else
            Log::warning('unknown decode type at : ' . $this->file_data[0]);
        list(,$path) = explode('temp',$this->file_data[0]);

        Storage::disk('local')->put($path,$file);
    }
}
