<?php

declare(strict_types=1);

namespace midorikocak\view;

class Section
{
    private ?string $title = null;

    /** @var string[] Paragraphs */
    private array $content;

    public function __construct(?string $title)
    {
        if ($title !== '') {
            $this->title = $title;
        }
    }

    public function addParagraph(string $content)
    {
        $this->content [] = $content;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}
