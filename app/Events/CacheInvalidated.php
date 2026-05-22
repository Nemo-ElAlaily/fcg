<?php

namespace App\Events;

class CacheInvalidated
{
    public array $keys;

    public function __construct(array $keys)
    {
        $this->keys = $keys;
    }
}
