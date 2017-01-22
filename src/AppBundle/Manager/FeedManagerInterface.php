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
     *
     * @return ArrayCollection
     */
    public function mergeFeeds(array $feeds): ArrayCollection;
}
