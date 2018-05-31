<?php

namespace Sherlockode\DocumentBundle\Model;

use Sherlockode\DocumentBundle\Finder\TemplatePageFinderInterface;

class Document
{
    /**
     * @var string
     */
    private $template;

    /**
     * @var Page[]
     */
    private $pages = [];

    /**
     * @var array
     */
    private $defaultParams = [];

    /**
     * @var TemplatePageFinderInterface
     */
    private $templateFinder;

    /**
     * Document constructor.
     *
     * @param string                      $template
     * @param TemplatePageFinderInterface $templateFinder
     */
    public function __construct($template, TemplatePageFinderInterface $templateFinder)
    {
        $this->template = $template;
        $this->templateFinder = $templateFinder;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return Page[]
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param array $defaultParams
     *
     * @return $this
     */
    public function setDefaultParams($defaultParams = [])
    {
        $this->defaultParams = $defaultParams;

        return $this;
    }

    /**
     * @param string $code
     * @param array  $parameters
     * @param array  $options
     *
     * @return $this
     */
    public function addPage($code, array $parameters = [], array $options = [])
    {
        $file = $this->templateFinder->getTemplatePath($code);
        $parameters = array_merge($this->defaultParams, $parameters);
        $page = new Page($code, $file, $parameters);
        $title = isset($options['title']) ? $options['title'] : $code;
        $page->setTitle($title);
        $this->pages[] = $page;

        return $this;
    }
}
