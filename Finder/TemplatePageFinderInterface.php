<?php

namespace Sherlockode\DocumentBundle\Finder;

/**
 * Interface TemplatePageFinderInterface
 */
interface TemplatePageFinderInterface
{
    /**
     * @param string $code
     *
     * @return string
     */
    public function getTemplatePath($code);
}
