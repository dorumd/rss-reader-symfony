<?php

namespace Tests\Repository;

use AppBundle\Repository\FeedItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Tests\AppBundle\Traits\FeedTrait;

class FeedItemRepositoryTest extends \PHPUnit_Framework_TestCase
{
    use FeedTrait;

    public function testFindByTitle()
    {
        $feedItemsCollection = new ArrayCollection();

        $feedItemsCollection->add($this->createDummyFeedItem('Foo'));
        $feedItemsCollection->add($this->createDummyFeedItem('Foo2'));
        $feedItemsCollection->add($this->createDummyFeedItem('Bar'));

        $results = FeedItemRepository::findByTitle($feedItemsCollection, 'Foo');

        $this->assertEquals(2, $results->count());
    }
}
