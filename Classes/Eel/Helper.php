<?php
declare(strict_types=1);

namespace NEOSidekick\HtmlContent\Eel;

use NEOSidekick\HtmlContent\Dto\HtmlParsingResultDto;
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
        return !$this->postProcessHtml($html)->hasErrors();
    }

    public function postProcessHtml($html = ''): HtmlParsingResultDto
    {
        $internalErrorsInitialState = libxml_use_internal_errors(true);
        $dom = new DOMDocument;
        $dom->loadHTML($html);
        $postProcessedBodyNode = $dom->getElementsByTagName('body')->item(0);
        $postProcessedHtml = str_replace(['<body>', '</body>'], '', $dom->saveHTML($postProcessedBodyNode));
        // We filter some of the errors because they are false-positives
        // e.g. code 801 => wrong tag name
        // For more codes see: https://gnome.pages.gitlab.gnome.org/libxml2/devhelp/libxml2-xmlerror.html
        $result = [];
        foreach (libxml_get_errors() as $error) {
            // Skip unknown tags
            if ($error->code === 801) {
                continue;
            }

            $result[] = $error;
        }

        libxml_use_internal_errors($internalErrorsInitialState);

        return new HtmlParsingResultDto($html, $postProcessedHtml, $result);
    }

    /**
     * All methods are considered safe
     */
    public function allowsCallOfMethod($methodName): bool
    {
        return true;
    }
}
