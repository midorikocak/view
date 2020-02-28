<?php

declare(strict_types=1);

namespace midorikocak\view;

use eftec\bladeone\BladeOne;

class BladeRenderer implements RendererInterface
{
    private BladeOne $renderer;

    public function __construct($viewPaths = '', $cachePath = '')
    {
        if ($viewPaths !== '' && $viewPaths !== '') {
            $this->renderer = new BladeOne($viewPaths, $cachePath, BladeOne::MODE_AUTO);
        }
    }

    public function render(string $filename, array $data = []): string
    {
        return $this->renderer->run($filename, $data);
    }
}
