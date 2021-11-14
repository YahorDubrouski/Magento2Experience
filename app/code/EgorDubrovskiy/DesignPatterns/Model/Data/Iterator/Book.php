<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Iterator;

class Book
{
    private string $nameOfAuthor = '';

    private string $name = '';

    public function setName(string $name): Book
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setNameOfAuthor(string $nameOfAuthor): Book
    {
        $this->nameOfAuthor = $nameOfAuthor;

        return $this;
    }

    public function getNameOfAuthor(): string
    {
        return $this->nameOfAuthor;
    }
}
