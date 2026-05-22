<?php

namespace App\Listeners;

use App\Events\CacheInvalidated;
use function forgetCacheKeys;

class HandleCacheInvalidation
{
    /**
     * Handle the event.
     *
     * @param  CacheInvalidated  $event
     * @return void
     */
    public function handle(CacheInvalidated $event)
    {
        forgetCacheKeys($event->keys);
    }
}
