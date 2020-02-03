<?php

declare(strict_types=1);

// phpcs:disable Generic.PHP.ForbiddenFunctions

namespace midorikocak\view;

use function array_map;
use function array_unique;
use function count;
use function file_get_contents;
use function preg_match_all;
use function preg_replace;
use function str_replace;
use function trim;

class TemplateRenderer implements RendererInterface
{
    public function render(string $filename, array $data): string
    {
        $templateContents = file_get_contents($filename);
        preg_match_all('/{{ *([a-zA-Z_0-9-]*)? *}}/', $templateContents, $templateVars);

        $templateVarNames = array_unique(array_map(function ($item) {
            return trim($item);
        }, $templateVars[1]));

        $tokenized = preg_replace('/{{ *([a-zA-Z_0-9-]*)? *}}/', '{{$1}}', $templateContents);

        foreach ($templateVarNames as $toReplace) {
            $tokenized = str_replace('{{' . $toReplace . '}}', $data[$toReplace] ?? '', $tokenized);
        }
        return $tokenized;
    }
}
