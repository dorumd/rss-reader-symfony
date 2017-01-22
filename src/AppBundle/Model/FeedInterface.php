<?php

namespace AppBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface FeedInterface
 * @package AppBundle\Model
 */
interface FeedInterface
{
    /**
     * Get feed title
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Get feed link
     *
     * @return string
     */
    public function getLink(): string;

    /**
     * Get feed items
     *
     * @param string $title
     *
     * @return ArrayCollection
     */
    public function getItems($title = ''): ArrayCollection;

    /**
     * Add feed item
     *
     * @param FeedItemInterface $feedItem
     *
     * @return FeedInterface
     */
    public function addItem(FeedItemInterface $feedItem): FeedInterface;

    /**
     * Remove feed item
     *
     * @param FeedItemInterface $feedItem
     *
     * @return FeedInterface
     */
    public function removeItem(FeedItemInterface $feedItem): FeedInterface;
}
