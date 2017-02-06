<?php

namespace Tests\FeedManager;

use AppBundle\Manager\FeedManager;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Model\FeedInterface;
use Tests\AppBundle\Traits\FeedTrait;

class FeedManagerTest extends \PHPUnit_Framework_TestCase
{
    use FeedTrait;

    const FEED_ITEMS_LIMIT = 10;

    public function testMergeFeeds()
    {
        $feeds = [];

        /** @var FeedInterface|\PHPUnit_Framework_MockObject_MockObject $fooFeed */
        $fooFeed = $this->createMock(FeedInterface::class);
        $fooFeed->method('getItems')->withAnyParameters()->willReturn($this->setupFeedItems(self::FEED_ITEMS_LIMIT + 2));

        $mergedFeedsCollection = FeedManager::mergeFeeds($feeds, self::FEED_ITEMS_LIMIT);
        $this->assertLessThanOrEqual(self::FEED_ITEMS_LIMIT, $mergedFeedsCollection->count());
    }

    public function testMergeSkipsWrongObjects()
    {
        $feeds = [];

        /** @var FeedInterface|\PHPUnit_Framework_MockObject_MockObject $fooFeed */
        $fooFeed = $this->getMockBuilder(\stdClass::class)->setMethods(['getItems'])->getMock();
        $fooFeed->method('getItems')->withAnyParameters()->willReturn($this->setupFeedItems(self::FEED_ITEMS_LIMIT));

        $mergedFeedsCollection = FeedManager::mergeFeeds($feeds, self::FEED_ITEMS_LIMIT);
        $this->assertEquals(0, $mergedFeedsCollection->count());
    }

    private function setupFeedItems(int $count): ArrayCollection
    {
        $feedItems = new ArrayCollection();

        for ($i = 0; $i < $count; $i++) {
            $feedItems->add($this->createDummyFeedItem());
        }

        return $feedItems;
    }
}