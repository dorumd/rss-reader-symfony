<?php

namespace Tests\AppBundle\Traits;

use AppBundle\Model\FeedItem;
use AppBundle\Model\FeedItemInterface;

trait FeedTrait
{
    /**
     * Create feed xml
     *
     * @param string $title Feed Title
     * @param string $url   Feed URL
     *
     * @return \SimpleXMLElement
     */
    private function getValidFeedXML($title, $url): \SimpleXMLElement
    {
        $feedXML = new \SimpleXMLElement('<rss></rss>');
        $channel = $feedXML->addChild('channel');
        $channel->addChild('title', $title);
        $channel->addChild('link', $url);

        return $feedXML;
    }

    /**
     * Create feed item xml
     *
     * @param string $title       Feed Item Title
     * @param string $link        Feed Item Link
     * @param string $pubDate     Feed Item Publish Date
     * @param string $description Feed Item Description
     *
     * @return \SimpleXMLElement
     */
    private function getValidFeedItemXML($title, $link, $pubDate, $description): \SimpleXMLElement
    {
        $feedItemXML = new \SimpleXMLElement('<item></item>');
        $feedItemXML->addChild('title', $title);
        $feedItemXML->addChild('link', $link);
        $feedItemXML->addChild('pubDate', $pubDate);
        $feedItemXML->addChild('description', $description);

        return $feedItemXML;
    }

    /**
     * Create a dummy feed item
     *
     * @param string $title Feed Item Title
     *
     * @return FeedItemInterface
     */
    private function createDummyFeedItem($title = 'Title'): FeedItemInterface
    {
        return new FeedItem($title, new \DateTime(), 'Description', '');
    }
}
