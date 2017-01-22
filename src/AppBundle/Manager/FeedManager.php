<?php

namespace AppBundle\Manager;

use AppBundle\Model\FeedInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * Class FeedManager
 * @package AppBundle\Manager
 * @author  Mardari Dorel <mardari.dorua@gmail.com>
 */
class FeedManager
{
    /**
     * @param []FeedInterface $feeds
     * @param int $maxResults
     *
     * @return ArrayCollection
     */
    public static function mergeFeeds(array $feeds, int $maxResults): ArrayCollection
    {
        $feedItems = [];

        /** @var FeedInterface $feed */
        foreach ($feeds as $feed) {
            if (!($feed instanceof FeedInterface)) {
                continue;
            }

            $feedItems = array_merge($feedItems, $feed->getItems()->toArray());
        }

        $feedItemsCollection = new ArrayCollection($feedItems);

        $criteria = Criteria::create()
            ->orderBy(['date' => 'DESC'])
            ->setMaxResults($maxResults)
        ;

        return $feedItemsCollection->matching($criteria);
    }
}
