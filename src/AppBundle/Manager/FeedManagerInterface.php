<?php

namespace AppBundle\Manager;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface FeedManagerInterface
 * @package AppBundle\Manager
 */
interface FeedManagerInterface
{
    /**
     * Merge multiple feeds
     *
     * @param array $feeds
     * @param int $maxResults
     *
     * @return ArrayCollection
     */
    public static function mergeFeeds(array $feeds, int $maxResults): ArrayCollection;
}
