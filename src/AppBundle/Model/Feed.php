<?php

namespace AppBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * Class Feed
 * @package AppBundle\Model
 * @author  Mardari Dorel <mardari.dorua@gmail.com>
 */
class Feed implements FeedInterface
{
    /** @var string */
    private $title;

    /** @var string */
    private $link;

    /** @var ArrayCollection|[]FeedItemInterface */
    private $items;

    /**
     * Feed constructor.
     *
     * @param string $title
     * @param string $link
     */
    public function __construct($title, $link)
    {
        $this->title = $title;
        $this->link = $link;
        $this->items = new ArrayCollection();
    }

    /**
     * @inheritdoc
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @inheritdoc
     */
    public function getItems($title = ''): ArrayCollection
    {
        if (strlen($title) > 0) {
            return $this->getNamedItems($title);
        }

        return $this->items;
    }

    /**
     * @inheritdoc
     */
    public function addItem(FeedItemInterface $feedItem): FeedInterface
    {
        $this->items->add($feedItem);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function removeItem(FeedItemInterface $feedItem): FeedInterface
    {
        $this->items->remove($feedItem);

        return $this;
    }

    public function getNamedItems($title): ArrayCollection
    {
    }
}
