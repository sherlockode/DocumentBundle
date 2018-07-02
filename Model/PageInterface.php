<?php

namespace Sherlockode\DocumentBundle\Model;

use Sherlockode\DocumentBundle\Pager\IndexEntry;

interface PageInterface
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @return string
     */
    public function getFile();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return int
     */
    public function getPageCount();

    /**
     * @param int $count
     */
    public function setPageCount($count);

    /**
     * @return int
     */
    public function getPageNumber();

    /**
     * @return array
     */
    public function getParameters();

    /**
     * @return array
     */
    public function getIndexEntries();

    /**
     * @param IndexEntry $entry
     */
    public function addIndexEntry(IndexEntry $entry);
}
