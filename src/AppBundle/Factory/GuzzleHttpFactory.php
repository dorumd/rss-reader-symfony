<?php

namespace AppBundle\Factory;

use Doctrine\Common\Cache\FilesystemCache;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\DoctrineCacheStorage;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;

class GuzzleHttpFactory
{
    public static function createCacheMiddleware()
    {
        return new CacheMiddleware(
            new PrivateCacheStrategy(
                new DoctrineCacheStorage(
                    new FilesystemCache('/tmp/requests-cache')
                )
            )
        );
    }
}
