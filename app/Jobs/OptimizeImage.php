<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OptimizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 300;
    public $tries = 3;

    protected $imagePath;
    protected $maxWidth;
    protected $quality;

    /**
     * Create a new job instance.
     *
     * @param string $imagePath Full path to the image file
     * @param int $maxWidth Maximum width to resize to (optional)
     * @param int $quality JPEG quality (1-100, default 85)
     * @return void
     */
    public function __construct($imagePath, $maxWidth = 1920, $quality = 85)
    {
        $this->imagePath = $imagePath;
        $this->maxWidth = $maxWidth;
        $this->quality = $quality;
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
                Log::warning('Image not found for optimization', ['path' => $this->imagePath]);
                return;
            }

            $imageInfo = getimagesize($this->imagePath);
            if (!$imageInfo) {
                Log::warning('Invalid image file', ['path' => $this->imagePath]);
                return;
            }

            list($width, $height, $type) = $imageInfo;

            // Skip if already small enough
            if ($width <= $this->maxWidth) {
                Log::info('Image already optimized', ['path' => $this->imagePath]);
                return;
            }

            // Calculate new dimensions
            $newWidth = $this->maxWidth;
            $newHeight = (int)(($newWidth / $width) * $height);

            // Create image resource based on type
            $source = null;
            switch ($type) {
                case IMAGETYPE_JPEG:
                    $source = imagecreatefromjpeg($this->imagePath);
                    break;
                case IMAGETYPE_PNG:
                    $source = imagecreatefrompng($this->imagePath);
                    break;
                case IMAGETYPE_GIF:
                    $source = imagecreatefromgif($this->imagePath);
                    break;
                default:
                    Log::warning('Unsupported image type', ['type' => $type]);
                    return;
            }

            if (!$source) {
                Log::error('Failed to create image resource', ['path' => $this->imagePath]);
                return;
            }

            // Create new image
            $destination = imagecreatetruecolor($newWidth, $newHeight);

            // Preserve transparency for PNG and GIF
            if ($type == IMAGETYPE_PNG || $type == IMAGETYPE_GIF) {
                imagealphablending($destination, false);
                imagesavealpha($destination, true);
                $transparent = imagecolorallocatealpha($destination, 255, 255, 255, 127);
                imagefilledrectangle($destination, 0, 0, $newWidth, $newHeight, $transparent);
            }

            // Resize
            imagecopyresampled($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // Save based on type
            $backup = $this->imagePath . '.backup';
            rename($this->imagePath, $backup);

            $saved = false;
            switch ($type) {
                case IMAGETYPE_JPEG:
                    $saved = imagejpeg($destination, $this->imagePath, $this->quality);
                    break;
                case IMAGETYPE_PNG:
                    $saved = imagepng($destination, $this->imagePath, 9);
                    break;
                case IMAGETYPE_GIF:
                    $saved = imagegif($destination, $this->imagePath);
                    break;
            }

            if ($saved) {
                unlink($backup);
                Log::info('Image optimized successfully', [
                    'path' => $this->imagePath,
                    'old_size' => filesize($backup),
                    'new_size' => filesize($this->imagePath),
                    'savings' => round((1 - filesize($this->imagePath) / filesize($backup)) * 100, 2) . '%'
                ]);
            } else {
                rename($backup, $this->imagePath);
                Log::error('Failed to save optimized image', ['path' => $this->imagePath]);
            }

            imagedestroy($source);
            imagedestroy($destination);

        } catch (\Exception $e) {
            Log::error('Image optimization failed', [
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
        Log::error('OptimizeImage job failed', [
            'path' => $this->imagePath,
            'error' => $exception->getMessage()
        ]);
    }
}
