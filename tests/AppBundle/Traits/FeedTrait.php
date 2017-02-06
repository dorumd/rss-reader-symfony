<?php

namespace Tests\AppBundle\Traits;

use AppBundle\Model\FeedItem;
use AppBundle\Model\FeedItemInterface;

trait FeedTrait
{
    /**
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

    private function getValidFeedItemXML($title, $link, $pubDate, $description): \SimpleXMLElement
    {
        $feedItemXML = new \SimpleXMLElement('<item></item>');
        $feedItemXML->addChild('title', $title);
        $feedItemXML->addChild('link', $link);
        $feedItemXML->addChild('pubDate', $pubDate);
        $feedItemXML->addChild('description', $description);

        return $feedItemXML;
    }

    private function createDummyFeedItem($title = 'Title'): FeedItemInterface
    {
        return new FeedItem($title, new \DateTime(), 'Description', '');
    }
}
