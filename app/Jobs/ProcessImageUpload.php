<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessImageUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 300;
    public $tries = 3;

    protected $imagePath;
    protected $folder;
    protected $optimize;

    /**
     * Create a new job instance.
     *
     * @param string $imagePath Full path to the uploaded image
     * @param string $folder Destination folder for the image
     * @param bool $optimize Whether to optimize the image
     * @return void
     */
    public function __construct($imagePath, $folder, $optimize = true)
    {
        $this->imagePath = $imagePath;
        $this->folder = $folder;
        $this->optimize = $optimize;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            if (!file_exists($this->imagePath)) {
                Log::warning('Uploaded image not found', ['path' => $this->imagePath]);
                return;
            }

            // Validate image
            $imageInfo = getimagesize($this->imagePath);
            if (!$imageInfo) {
                Log::warning('Invalid image file uploaded', ['path' => $this->imagePath]);
                return;
            }

            // Move to destination folder if needed
            if ($this->folder && dirname($this->imagePath) !== $this->folder) {
                $filename = basename($this->imagePath);
                $destination = $this->folder . '/' . $filename;

                if (!is_dir($this->folder)) {
                    mkdir($this->folder, 0755, true);
                }

                if (rename($this->imagePath, $destination)) {
                    $this->imagePath = $destination;
                    Log::info('Image moved to destination', ['path' => $destination]);
                }
            }

            // Dispatch optimization job if requested
            if ($this->optimize) {
                OptimizeImage::dispatch($this->imagePath, 1920, 85)->onQueue('images');
                Log::info('Image optimization job dispatched', ['path' => $this->imagePath]);
            }

        } catch (\Exception $e) {
            Log::error('Image processing failed', [
                'path' => $this->imagePath,
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
        Log::error('ProcessImageUpload job failed', [
            'path' => $this->imagePath,
            'error' => $exception->getMessage()
        ]);
    }
}
