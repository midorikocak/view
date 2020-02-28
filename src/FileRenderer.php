<?php

declare(strict_types=1);

// phpcs:disable Generic.PHP.ForbiddenFunctions

namespace midorikocak\view;

use function extract;
use function ob_get_clean;
use function ob_start;

use const EXTR_OVERWRITE;

class FileRenderer implements RendererInterface
{
    public function render(string $filename, array $data = []): string
    {
        return (function () use ($filename, $data) {
            ob_start();
            extract($data, EXTR_OVERWRITE);
            include $filename;
            return ob_get_clean();
        })();
    }
}
