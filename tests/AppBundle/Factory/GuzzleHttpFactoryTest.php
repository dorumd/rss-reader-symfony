<?php

namespace Tests\Factory;

use AppBundle\Factory\GuzzleHttpFactory;
use Kevinrob\GuzzleCache\CacheMiddleware;
use AppBundle\Cache\ExpirableCacheStrategy;

class GuzzleHttpFactoryTest extends \PHPUnit_Framework_TestCase
{
    const TTL = 30;

    /** @var GuzzleHttpFactory */
    private $guzzleHttpFactory;

    protected function setUp()
    {
        $this->guzzleHttpFactory = new GuzzleHttpFactory(self::TTL);
    }

    protected function tearDown()
    {
        $this->guzzleHttpFactory = null;
    }

    public function testCreateCacheMiddleware()
    {
        /** @var CacheMiddleware $cacheMiddleware */
        $cacheMiddleware = $this->guzzleHttpFactory->createCacheMiddleware();

        $this->assertInstanceOf(CacheMiddleware::class, $cacheMiddleware);
        $this->assertInstanceOf(ExpirableCacheStrategy::class, $cacheMiddleware->getCacheStorage());
    }
}
