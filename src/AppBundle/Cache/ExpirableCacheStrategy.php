<?php

namespace AppBundle\Cache;

use Kevinrob\GuzzleCache\CacheEntry;
use Kevinrob\GuzzleCache\Storage\CacheStorageInterface;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ExpirableCache
 * @package AppBundle\Cache
 * @author  Mardari Dorel <mardari.dorua@gmail.com>
 */
class ExpirableCacheStrategy extends PrivateCacheStrategy
{
    /**
     * @var int
     */
    protected $ttl;

    /**
     * ExpirableCacheStrategy constructor.
     *
     * @param CacheStorageInterface|null $cache
     * @param int $ttl
     */
    public function __construct(CacheStorageInterface $cache = null, $ttl = 30)
    {
        parent::__construct($cache);

        $this->ttl = $ttl;
    }

    /**
     * @inheritdoc
     */
    protected function getCacheObject(RequestInterface $request, ResponseInterface $response)
    {
        return new CacheEntry($request, $response, new \DateTime('+' . $this->ttl . ' seconds'));
    }
}
