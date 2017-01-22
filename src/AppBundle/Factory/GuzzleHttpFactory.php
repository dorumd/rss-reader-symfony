<?php

namespace AppBundle\Factory;

use AppBundle\Cache\ExpirableCacheStrategy;
use Doctrine\Common\Cache\FilesystemCache;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\DoctrineCacheStorage;

/**
 * Class GuzzleHttpFactory
 * @package AppBundle\Factory
 * @author  Mardari Dorel <mardari.dorua@gmail.com>
 */
class GuzzleHttpFactory
{
    /** @var int */
    private $cacheTTL;

    /**
     * GuzzleHttpFactory constructor.
     *
     * @param int $cacheTTL
     */
    public function __construct($cacheTTL)
    {
        $this->cacheTTL = $cacheTTL;
    }

    /**
     * Create cache middleware
     *
     * @return CacheMiddleware
     */
    public function createCacheMiddleware(): CacheMiddleware
    {
        return new CacheMiddleware(
            new ExpirableCacheStrategy(
                new DoctrineCacheStorage(
                    new FilesystemCache('/tmp/requests-cache')
                ),
                $this->cacheTTL
            )
        );
    }
}
