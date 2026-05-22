<?php

namespace Tests\Feature;

use App\Events\CacheInvalidated;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CacheInvalidationTest extends TestCase
{
    public function test_forget_cache_keys_helper_clears_multiple_cache_keys()
    {
        Cache::put('test.cache.key.1', 'value1', 60);
        Cache::put('test.cache.key.2', 'value2', 60);

        $this->assertTrue(Cache::has('test.cache.key.1'));
        $this->assertTrue(Cache::has('test.cache.key.2'));

        forgetCacheKeys(['test.cache.key.1', 'test.cache.key.2']);

        $this->assertFalse(Cache::has('test.cache.key.1'));
        $this->assertFalse(Cache::has('test.cache.key.2'));
    }

    public function test_cache_invalidated_event_dispatch_triggers_listener()
    {
        Cache::put('test.cache.event.key', 'value', 60);

        $this->assertTrue(Cache::has('test.cache.event.key'));

        event(new CacheInvalidated(['test.cache.event.key']));

        $this->assertFalse(Cache::has('test.cache.event.key'));
    }
}
