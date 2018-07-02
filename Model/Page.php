<?php

namespace Sherlockode\DocumentBundle\Model;

use Sherlockode\DocumentBundle\Pager\IndexEntry;

/**
 * Class Page
 */
class Page implements PageInterface
{
    private $code;
    private $file;
    private $title;
    private $indexEntries = [];
    private $parameters;
    private $pageCount;
    private $pageNumber;

    public function __construct($code, $file, array $parameters = [])
    {
        $this->pageCount = 1;
        $this->code = $code;
        $this->file = $file;
        $this->parameters = $parameters;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getPageCount()
    {
        return $this->pageCount;
    }

    public function setPageCount($count)
    {
        $this->pageCount = $count;
    }

    public function getPageNumber()
    {
        return $this->pageNumber;
    }
    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;
    }

    /**
     * @return IndexEntry[]
     */
    public function getIndexEntries()
    {
        return $this->indexEntries;
    }
    public function setIndexEntries($indexEntries)
    {
        $this->indexEntries = $indexEntries;
    }

    public function addIndexEntry(IndexEntry $entry)
    {
        $currentStart = $this->getPageNumber();
        foreach ($this->getIndexEntries() as $existingEntry) {
            $currentStart += $existingEntry->getPageLength();
        }
        $entry->setStart($currentStart);
        $this->indexEntries[] = $entry;
    }
}
