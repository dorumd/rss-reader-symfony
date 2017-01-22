<?php

namespace AppBundle\Model;

/**
 * Interface FeedItemInterface
 * @package AppBundle\Model
 */
interface FeedItemInterface
{
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate(): \DateTime;

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get image
     *
     * @return string
     */
    public function getImage(): string;
}
