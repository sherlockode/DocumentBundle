<?php

namespace  Sherlockode\DocumentBundle\Finder;

class TemplatePageFinder implements TemplatePageFinderInterface
{
    /**
     * @var string
     */
    private $outputFormat;

    /**
     * @var string
     */
    private $extension;

    /**
     * @var string
     */
    private $pathPrefix;

    public function __construct($outputFormat, $format, $extension, $pathPrefix)
    {
        $this->outputFormat = $outputFormat;
        $this->extension = $extension;
        $this->pathPrefix = $pathPrefix;
    }

    /**
     * @param string $code
     *
     * @return string
     */
    public function getTemplatePath($code)
    {
        return sprintf('%s/%s.%s.%s', $code, $this->prefix, $this->outputFormat, $this->extension);
    }
}
