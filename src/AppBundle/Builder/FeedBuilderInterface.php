<?php

namespace AppBundle\Builder;

use AppBundle\Model\FeedInterface;
use GuzzleHttp\HandlerStack;

/**
 * Interface FeedBuilderInterface
 * @package AppBundle\Builder
 */
interface FeedBuilderInterface
{
    /**
     * Create feed
     *
     * @return mixed
     */
    public function createFeed();

    /**
     * Create feed item
     *
     * @param \SimpleXMLElement $item
     *
     * @return mixed
     */
    public function createFeedItem(\SimpleXMLElement $item);

    /**
     * Fetch feed
     *
     * @param HandlerStack $stack
     *
     * @return mixed
     */
    public function fetchFeed(HandlerStack $stack);

    /**
     * Get feed
     *
     * @return FeedInterface
     */
    public function getFeed(): FeedInterface;

    /**
     * Get feed xml
     *
     * @return \SimpleXMLElement
     *
     * @throws \Exception
     */
    public function getFeedXML(): \SimpleXMLElement;
}
