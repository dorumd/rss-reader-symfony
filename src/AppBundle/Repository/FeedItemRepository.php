<?php

namespace AppBundle\Repository;

use AppBundle\Model\FeedItemInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class FeedItemRepository
 * @package AppBundle\Repository
 * @author  Mardari Dorel <mardari.dorua@gmail.com>
 */
class FeedItemRepository
{
    public static function findByTitle(ArrayCollection $items, $title = ''): ArrayCollection
    {
        if (strlen($title) === 0) {
            return $items;
        }

        $results = new ArrayCollection();

        /** @var FeedItemInterface $item */
        foreach ($items as $item) {
            if (strpos(strtolower($item->getTitle()), strtolower($title)) !== false) {
                $results->add($item);
            }
        }

        return $results;
    }
}
