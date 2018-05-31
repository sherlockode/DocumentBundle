<?php

namespace Sherlockode\DocumentBundle\Pager;

use Sherlockode\DocumentBundle\Model\Page;

/**
 * Class SimplePager
 */
class SimplePager implements PagerInterface
{
    public function processPageCount(Page $page)
    {
        $page->setPageCount(1);
    }

    public function processPageTitle(Page $page)
    {
        $page->addIndexEntry(new IndexEntry($page->getTitle(), $page->getPageCount()));
    }
}
