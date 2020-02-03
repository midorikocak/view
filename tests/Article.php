<?php

declare(strict_types=1);

namespace midorikocak\view;

class Article
{
    use ViewableTrait;

    private string $title;
    private string $created;

    /** @var Section[] */
    private array $sections;

    public function __construct($title, $created)
    {
        $this->title = $title;
        $this->created = $created;
    }

    public function addSection(Section $section)
    {
        $this->sections[] = $section;
    }

    public function toArray(): array
    {
        $toReturn = [
            'title' => $this->title,
            'created' => $this->created,
            'sections' => [],
        ];

        foreach ($this->sections as $section) {
            $toReturn['sections'][] = $section->toArray();
        }
        return $toReturn;
    }
}
