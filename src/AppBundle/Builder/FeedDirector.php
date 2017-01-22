<?php

namespace AppBundle\Builder;

use AppBundle\Model\FeedInterface;

/**
 * Class FeedDirector
 * @package AppBundle\Builder
 * @author  Mardari Dorel <mardari.dorua@gmail.com>
 */
class FeedDirector
{
    /** @var int */
    private $feedItemsLimit;

    /**
     * FeedDirector constructor.
     *
     * @param $feedItemsLimit
     */
    public function __construct($feedItemsLimit)
    {
        $this->feedItemsLimit = $feedItemsLimit;
    }

    /**
     * Build feed
     *
     * @param FeedBuilderInterface $builder
     *
     * @return FeedInterface
     */
    public function build(FeedBuilderInterface $builder): FeedInterface
    {
        $builder->fetchFeed();
        $builder->createFeed();

        $feedItems = $builder->getFeedXML()->channel->item;

        foreach ($feedItems as $item) {
            if ($builder->getFeed()->getItems()->count() >= $this->feedItemsLimit) {
                break;
            }

            $builder->createFeedItem($item);
        }

        return $builder->getFeed();
    }
}
