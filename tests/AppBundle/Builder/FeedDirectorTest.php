<?php

namespace Tests\AppBundle\Builder;

use AppBundle\Builder\FeedBuilderInterface;
use AppBundle\Model\FeedInterface;
use AppBundle\Builder\FeedDirector;
use GuzzleHttp\HandlerStack;
use Tests\AppBundle\Traits\FeedTrait;

class FeedDirectorTest extends \PHPUnit_Framework_TestCase
{
    use FeedTrait;

    const FEED_URL = 'http://my-feed.url';
    const FEED_SUFFIX = '/rss.xml';
    const FEED_TITLE = 'Feed Title';

    const FEED_ITEM_TITLE = 'Feed Item Title';
    const FEED_ITEM_LINK = 'http://item-1.url';
    const FEED_ITEM_PUB_DATE = '';
    const FEED_ITEM_DESCRIPTION = 'Feed Item Description';

    const FEED_ITEMS_LIMIT = 1;

    /** @var FeedBuilderInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $builder;

    /** @var HandlerStack|\PHPUnit_Framework_MockObject_MockObject */
    private $handlerStack;

    /** @var FeedDirector */
    private $feedDirector;

    protected function setUp()
    {
        $this->builder = $this->createMock(FeedBuilderInterface::class);
        $this->handlerStack = $this->getMockBuilder(HandlerStack::class)->disableOriginalConstructor()->getMock();
        $this->feedDirector = new FeedDirector(self::FEED_ITEMS_LIMIT, $this->handlerStack);
    }

    protected function tearDown()
    {
        $this->builder = null;
        $this->handlerStack = null;
        $this->feedDirector = null;
    }

    public function testBuild()
    {
        $feedXML = $this->getValidFeedXML(self::FEED_TITLE, self::FEED_URL);

        $this->builder->expects($this->once())->method('fetchFeed')->with($this->handlerStack);
        $this->builder->expects($this->once())->method('createFeed');
        $this->builder->expects($this->atLeastOnce())->method('getFeedXML')->willReturn($feedXML);

        $builtFeed = $this->feedDirector->build($this->builder);
        $this->assertInstanceOf(FeedInterface::class, $builtFeed);
    }
}
