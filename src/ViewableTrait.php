<?php

declare(strict_types=1);

namespace midorikocak\view;

trait ViewableTrait
{
    public ?View $view = null;
    public string $template = '';

    public function render(): string
    {
        $this->view ??= new View(new FileRenderer());
        if ($this->template === '') {
            return '';
        }
        $this->view->setTemplate($this->template);
        return $this->view->render($this->toArray());
    }
}
