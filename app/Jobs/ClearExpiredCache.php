<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ClearExpiredCache implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 60;

    protected $cacheKeys;

    /**
     * Create a new job instance.
     *
     * @param array $cacheKeys Array of cache keys to clear
     * @return void
     */
    public function __construct(array $cacheKeys = [])
    {
        $this->cacheKeys = $cacheKeys;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            if (empty($this->cacheKeys)) {
                // Clear all cache if no specific keys provided
                Cache::flush();
                Log::info('All cache cleared');
            } else {
                // Clear specific cache keys
                foreach ($this->cacheKeys as $key) {
                    Cache::forget($key);
                }
                Log::info('Cache keys cleared', ['keys' => $this->cacheKeys]);
            }
        } catch (\Exception $e) {
            Log::error('Cache clearing failed', [
                'keys' => $this->cacheKeys,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(\Throwable $exception)
    {
        Log::error('ClearExpiredCache job failed', [
            'keys' => $this->cacheKeys,
            'error' => $exception->getMessage()
        ]);
    }
}
