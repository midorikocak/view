<?php

declare(strict_types=1);

// phpcs:disable Generic.PHP.ForbiddenFunctions

namespace midorikocak\view;

use function header;

class HtmlRenderer extends FileRenderer
{
    public function render(string $filename, array $data = []): string
    {
        header("Content-Type: text/html");
        return parent::render($filename, $data);
    }
}
