<?php

namespace Sherlockode\DocumentBundle\Pager;

use Sherlockode\DocumentBundle\Model\PageInterface;

/**
 * Class SimplePager
 */
class SimplePager implements PagerInterface
{
    public function processPageCount(PageInterface $page)
    {
        $page->setPageCount(1);
    }

    public function processPageTitle(PageInterface $page)
    {
        $page->addIndexEntry(new IndexEntry($page->getTitle(), $page->getPageCount()));
    }
}
