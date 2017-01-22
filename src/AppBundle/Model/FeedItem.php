<?php

namespace AppBundle\Model;

/**
 * Class FeedItem
 * @package AppBundle\Model
 * @author  Mardari Dorel <mardari.dorua@gmail.com>
 */
class FeedItem implements FeedItemInterface
{
    /** @var string */
    private $title;

    /** @var \DateTime */
    private $date;

    /** @var string */
    private $description;

    /** @var string */
    private $image;

    /**
     * FeedItem constructor.
     *
     * @param string $title
     * @param \DateTime $date
     * @param string $description
     * @param string $image
     */
    public function __construct(string $title, \DateTime $date, string $description, string $image)
    {
        $this->title = $title;
        $this->date = $date;
        $this->description = strlen($description) > 200 ? substr($description, 0, 200) : $description;
        $this->image = $image;
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
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @inheritdoc
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @inheritdoc
     */
    public function getImage(): string
    {
        return $this->image;
    }
}
