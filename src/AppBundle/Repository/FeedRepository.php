<?php

namespace AppBundle\Repository;
use AppBundle\Model\FeedInterface;
use AppBundle\Model\FeedItemInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class FeedRepository
 * @package AppBundle\Repository
 * @author  Mardari Dorel <mardari.dorua@gmail.com>
 */
class FeedRepository
{
    public static function findItemsByTitle(FeedInterface $feed, $title = ''): ArrayCollection
    {
        if (strlen($title) === 0) {
            return $feed->getItems();
        }

        $results = new ArrayCollection();

        /** @var FeedItemInterface $item */
        foreach ($feed->getItems() as $item) {
            if (strpos(strtolower($item->getTitle()), strtolower($title)) !== false) {
                $results->add($item);
            }
        }

        return $results;
    }
}
