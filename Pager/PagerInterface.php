<?php

namespace Sherlockode\DocumentBundle\Pager;

use Sherlockode\DocumentBundle\Model\Page;

/**
 * Interface PagerInterface
 */
interface PagerInterface
{
    public function processPageCount(Page $page);

    public function processPageTitle(Page $page);
}
