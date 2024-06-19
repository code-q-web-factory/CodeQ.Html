<?php

namespace NEOSidekick\HtmlContent\Dto;

use LibXMLError;
use Neos\Eel\ProtectedContextAwareInterface;
use Neos\Flow\Annotations as Flow;

/**
 * @Flow\ValueObject
 */
class HtmlParsingResultDto implements ProtectedContextAwareInterface
{
    /**
     * @var string
     */
    protected string $html;

    /**
     * @var array<LibXMLError>
     */
    protected array $errors;

    /**
     * @var bool
     */
    protected bool $hasAutofixedClosingTags;

    public function __construct(string $inputHtml, string $postProcessedHtml, array $errors)
    {
        $this->inputHtml = $inputHtml;
        $this->html = $postProcessedHtml;
        $this->errors = $errors;
        $this->hasAutofixedClosingTags = substr_count($postProcessedHtml, '</') > substr_count($inputHtml, '</');
    }

    public function getInputHtml(): string
    {
        return $this->inputHtml;
    }

    public function getHtml(): string
    {
        return $this->html;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    public function hasAutofixedClosingTags(): bool
    {
        return $this->hasAutofixedClosingTags;
    }

    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}
