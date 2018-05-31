<?php

namespace Sherlockode\DocumentBundle\Pager;

/**
 * Class IndexEntry
 */
class IndexEntry
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $start;

    /**
     * @var int
     */
    private $pageLength;

    /**
     * @var array
     */
    private $params;

    /**
     * IndexEntry constructor.
     *
     * @param string $title
     * @param int    $pageLength
     * @param array  $params
     */
    public function __construct($title, $pageLength = 1, $params = [])
    {
        $this->title = $title;
        $this->pageLength = $pageLength;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getPageLength()
    {
        return $this->pageLength;
    }

    /**
     * @return int
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param int $start
     *
     * @return $this
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    public function getParams()
    {
        return $this->params;
    }
}
