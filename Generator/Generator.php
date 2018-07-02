<?php

namespace Sherlockode\DocumentBundle\Generator;

use Sherlockode\DocumentBundle\Finder\TemplatePageFinderInterface;
use Sherlockode\DocumentBundle\Model\Document;
use Sherlockode\DocumentBundle\Model\DocumentInterface;
use Sherlockode\DocumentBundle\Model\PageInterface;
use Sherlockode\DocumentBundle\Pager\PagerInterface;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class Generator
 */
class Generator
{
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

    public function newDocument($templateFile)
    {
        return new Document($templateFile, $this->templateFinder);
    }

    /**
     * @param DocumentInterface $document
     * @param string             $contentVariableName
     *
     * @return string
     */
    public function render(DocumentInterface $document, $contentVariableName = 'content')
    {
        $this->prepareIndexTable($document);

        $content = '';
        foreach ($document->getPages() as $page) {
            $content .= $this->renderPage($page);
        }

        return $this->templateEngine->render($document->getTemplate(), [$contentVariableName => $content]);
    }

    /**
     * @param PageInterface $page
     *
     * @return string
     */
    public function renderPage(PageInterface $page)
    {
        $parameters = array_merge(['pageNumberStart' => $page->getPageNumber()], $page->getParameters());

        return $this->templateEngine->render($page->getFile(), $parameters);
    }

    private function prepareIndexTable(DocumentInterface $document)
    {
        $currentPage = 1;
        foreach ($document->getPages() as $page) {
            $page->setPageNumber($currentPage);
            $this->pager->processPageCount($page);
            $currentPage += $page->getPageCount();
            $this->pager->processPageTitle($page);
        }
    }
}
