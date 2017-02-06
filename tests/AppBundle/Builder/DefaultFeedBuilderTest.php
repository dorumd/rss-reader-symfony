<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Builder\DefaultFeedBuilder;
use AppBundle\Builder\FeedBuilderInterface;
use AppBundle\Model\FeedInterface;
use AppBundle\Model\FeedItemInterface;
use Tests\AppBundle\Traits\FeedTrait;

class DefaultFeedBuilderTest extends \PHPUnit_Framework_TestCase
{
    use FeedTrait;

    const FEED_URL = 'http://my-feed.url';
    const FEED_SUFFIX = '/rss.xml';
    const FEED_TITLE = 'Feed Title';

    const FEED_ITEM_TITLE = 'Feed Item Title';
    const FEED_ITEM_LINK = 'http://item-1.url';
    const FEED_ITEM_PUB_DATE = '';
    const FEED_ITEM_DESCRIPTION = 'Feed Item Description';

    /** @var FeedBuilderInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $defaultFeedBuilder;

    protected function setUp()
    {
        $this->defaultFeedBuilder = $this->getMock(DefaultFeedBuilder::class, ['getFeedXML'], [
            self::FEED_URL,
            self::FEED_SUFFIX
        ]);
    }

    protected function tearDown()
    {
        $this->defaultFeedBuilder = null;
    }

    public function testCreateAndGetFeed()
    {
        $this->setupValidFeed();
        $feed = $this->defaultFeedBuilder->getFeed();

        $this->assertInstanceOf(FeedInterface::class, $feed);
        $this->assertEquals(self::FEED_URL, $feed->getLink());
        $this->assertEquals(self::FEED_TITLE, $feed->getTitle());
    }

    public function testCreateFeedItem()
    {
        $this->setupValidFeed();
        $this->setupValidFeedItem();

        /** @var FeedItemInterface $feedItem */
        $feedItem = $this->defaultFeedBuilder->getFeed()->getItems()->first();

        $this->assertInstanceOf(FeedItemInterface::class, $feedItem);
        $this->assertEquals(self::FEED_ITEM_TITLE, $feedItem->getTitle());
        $this->assertEquals(self::FEED_ITEM_DESCRIPTION, $feedItem->getDescription());
    }

    protected function setupValidFeed()
    {
        $this
            ->defaultFeedBuilder
            ->expects($this->atLeastOnce())
            ->method('getFeedXML')
            ->willReturn($this->getValidFeedXML(self::FEED_TITLE, self::FEED_URL))
        ;

        $this->defaultFeedBuilder->createFeed();
    }

    protected function setupValidFeedItem()
    {
        $this->defaultFeedBuilder->createFeedItem($this->getValidFeedItemXML(
            self::FEED_ITEM_TITLE,
            self::FEED_ITEM_LINK,
            self::FEED_ITEM_PUB_DATE,
            self::FEED_ITEM_DESCRIPTION
        ));
    }
}