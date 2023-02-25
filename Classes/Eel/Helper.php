<?php
declare(strict_types=1);

namespace CodeQ\HtmlContent\Eel;

use Neos\Flow\Annotations as Flow;
use Neos\Eel\ProtectedContextAwareInterface;
use DOMDocument;

/**
 * @Flow\Proxy(false)
 */
class Helper implements ProtectedContextAwareInterface
{
    public function isValidHtml($html = ''): bool
    {
        return empty($this->getHtmlParsingErrors($html));
    }

    public function getHtmlParsingErrors($html = ''): array
    {
        $internalErrorsInitialState = libxml_use_internal_errors(true);
        $dom = new DOMDocument;
        $dom->loadHTML($html);
        $result = libxml_get_errors();
        libxml_use_internal_errors($internalErrorsInitialState);
        return $result;
    }

    /**
     * All methods are considered safe
     */
    public function allowsCallOfMethod($methodName): bool
    {
        return true;
    }
}
