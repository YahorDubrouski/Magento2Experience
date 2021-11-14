<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Memento;

class TextArea
{
    const COLOR_BLACK = 'black';
    const COLOR_READ = 'read';

    private string $text = '';

    private string $color = self::COLOR_BLACK;

    private TextAreaMementoFactory $mementoFactory;

    public function __construct(
        TextAreaMementoFactory $mementoFactory
    ) {
        $this->mementoFactory = $mementoFactory;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function createMemento(): TextAreaMemento
    {
        return $this->mementoFactory->create([
            'text' => $this->text,
            'color' => $this->color,
        ]);
    }

    public function restoreMemento(TextAreaMemento $memento): self
    {
        $this->text = $memento->getText();
        $this->color = $memento->getColor();

        return $this;
    }
}
