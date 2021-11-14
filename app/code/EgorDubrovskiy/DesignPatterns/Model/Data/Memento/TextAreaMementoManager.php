<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Memento;

use Exception;

class TextAreaMementoManager
{
    private array $mementos = [];

    private TextArea $textArea;

    public function __construct(
        TextArea $textArea
    ) {
        $this->textArea = $textArea;
    }

    public function saveCurrentMemento(): self
    {
        $memento = $this->textArea->createMemento();
        $this->mementos[] = $memento;

        return $this;
    }

    /**
     * @param int $index
     * @return TextAreaMemento
     * @throws Exception
     */
    public function getMementoByIndex(int $index): TextAreaMemento
    {
        if (isset($this->mementos[$index])) {
            return $this->mementos[$index];
        }

        throw new Exception('Memento was not found');
    }

    /**
     * @param int $index
     * @return $this
     * @throws Exception
     */
    public function restoreMementoByIndex(int $index): self
    {
        $memento = $this->getMementoByIndex($index);
        $this->textArea->restoreMemento($memento);

        return $this;
    }
}
