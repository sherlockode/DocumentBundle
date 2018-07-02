<?php

namespace Sherlockode\DocumentBundle\Model;

interface DocumentInterface
{
    /**
     * @return string
     */
    public function getTemplate();

    /**
     * @return Page[]
     */
    public function getPages();
}
