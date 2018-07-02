<?php

namespace Sherlockode\DocumentBundle\Pager;

use Sherlockode\DocumentBundle\Model\PageInterface;

/**
 * Interface PagerInterface
 */
interface PagerInterface
{
    public function processPageCount(PageInterface $page);

    public function processPageTitle(PageInterface $page);
}
