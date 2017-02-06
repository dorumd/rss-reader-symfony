<?php

namespace Tests\AppBundle\Cache;

use AppBundle\Cache\ExpirableCacheStrategy;
use Kevinrob\GuzzleCache\Storage\CacheStorageInterface;
use Kevinrob\GuzzleCache\CacheEntry;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Tests\AppBundle\Traits\CallMethodTrait;

class ExpirableCacheStrategyTest extends \PHPUnit_Framework_TestCase
{
    use CallMethodTrait;

    const CACHE_TTL = 30;

    /** @var CacheStorageInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $cacheStorage;

    /** @var ExpirableCacheStrategy */
    private $expirableCacheStrategy;

    protected function setUp()
    {
        $this->cacheStorage = $this->createMock(CacheStorageInterface::class);
        $this->expirableCacheStrategy = new ExpirableCacheStrategy($this->cacheStorage, self::CACHE_TTL);
    }

    protected function tearDown()
    {
        $this->cacheStorage = null;
        $this->expirableCacheStrategy = null;
    }

    public function testGetCacheObject()
    {
        /** @var RequestInterface|\PHPUnit_Framework_MockObject_MockObject $requestMock */
        $requestMock = $this->createMock(RequestInterface::class);
        /** @var ResponseInterface|\PHPUnit_Framework_MockObject_MockObject $responseMock */
        $responseMock = $this->createMock(ResponseInterface::class);

        $responseMock->expects($this->once())->method('getHeader')->with('Cache-Control')->willReturn([]);

        /** @var CacheEntry $cacheObject */
        $cacheObject = $this->callMethod($this->expirableCacheStrategy, 'getCacheObject', [$requestMock, $responseMock]);

        $this->assertInstanceOf(CacheEntry::class, $cacheObject);
        $this->assertEquals(
            (new \DateTime('+' . self::CACHE_TTL . ' seconds'))->format('Y-m-d h:i'),
            $cacheObject->getStaleAt()->format('Y-m-d h:i')
        );
    }
}
