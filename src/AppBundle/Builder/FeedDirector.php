<?php

namespace AppBundle\Builder;

use AppBundle\Model\FeedInterface;
use GuzzleHttp\HandlerStack;

/**
 * Class FeedDirector
 * @package AppBundle\Builder
 * @author  Mardari Dorel <mardari.dorua@gmail.com>
 */
class FeedDirector
{
    /** @var int */
    private $feedItemsLimit;

    /** @var HandlerStack */
    private $stack;

    /**
     * FeedDirector constructor.
     *
     * @param integer $feedItemsLimit
     * @param HandlerStack $stack
     */
    public function __construct($feedItemsLimit, $stack)
    {
        $this->feedItemsLimit = $feedItemsLimit;
        $this->stack = $stack;
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
        $builder->fetchFeed($this->stack);
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
