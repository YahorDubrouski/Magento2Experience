<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Memento;

class TextAreaMemento
{
    private string $text;

    private string $color;

    public function __construct(
        string $text,
        string $color
    ) {
        $this->text = $text;
        $this->color = $color;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}
