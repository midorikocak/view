<?php

declare(strict_types=1);

namespace midorikocak\view;

class View
{
    private RendererInterface $renderer;

    /** @var string is a filename */
    private string $template = '';

    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function setTemplate(string $template)
    {
        $this->template = $template;
    }

    public function render(array $data): string
    {
        //preg_match_all('/\$[a-zA-z0-9-_]+?\b/', $templateContents, $templateVars);
        return $this->renderer->render($this->template, $data);
    }
}
