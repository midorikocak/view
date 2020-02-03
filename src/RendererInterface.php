<?php

declare(strict_types=1);

namespace midorikocak\view;

interface RendererInterface
{
    public function render(string $template, array $data): string;
}
