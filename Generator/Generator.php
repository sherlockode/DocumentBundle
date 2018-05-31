<?php

namespace Sherlockode\DocumentBundle\Generator;

use Sherlockode\DocumentBundle\Finder\TemplatePageFinderInterface;
use Sherlockode\DocumentBundle\Model\Page;
use Sherlockode\DocumentBundle\Pager\PagerInterface;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class Generator
 */
class Generator
{
    /**
     * @var Page[]
     */
    private $pages = [];

    /**
     * @var EngineInterface
     */
    private $templateEngine;

    /**
     * @var PagerInterface
     */
    private $pager;

    /**
     * @var TemplatePageFinderInterface
     */
    private $templateFinder;

    /**
     * @var array
     */
    private $defaultParams = [];

    /**
     * Generator constructor.
     *
     * @param EngineInterface             $templateEngine
     * @param PagerInterface              $pager
     * @param TemplatePageFinderInterface $templateFinder
     */
    public function __construct(EngineInterface $templateEngine, PagerInterface $pager, $templateFinder)
    {
        $this->templateEngine = $templateEngine;
        $this->pager = $pager;
        $this->templateFinder = $templateFinder;
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

    /**
     * @param string $template
     * @param string $contentVariableName
     *
     * @return string
     */
    public function renderAll($template, $contentVariableName = 'content')
    {
        $this->prepareIndexTable();

        $content = '';
        foreach ($this->pages as $page) {
            $content .= $this->renderPage($page);
        }

        return $this->templateEngine->render($template, [$contentVariableName => $content]);
    }

    /**
     * @param Page $page
     *
     * @return string
     */
    public function renderPage(Page $page)
    {
        $parameters = array_merge(['pageNumberStart' => $page->getPageNumber()], $page->getParameters());

        return $this->templateEngine->render($page->getFile(), $parameters);
    }

    private function prepareIndexTable()
    {
        $currentPage = 1;
        foreach ($this->pages as $page) {
            $page->setPageNumber($currentPage);
            $this->pager->processPageCount($page);
            $currentPage += $page->getPageCount();
            $this->pager->processPageTitle($page);
        }
    }
}
