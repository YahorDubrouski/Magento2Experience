<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Iterator\BookList\Iterator;

use EgorDubrovskiy\DesignPatterns\Model\Data\Iterator\Book;
use Iterator;

class BooksSortedByNameIterator implements Iterator
{
    private array $books;

    private int $currentBookIndex = 0;

    public function __construct(array $books)
    {
        $this->books = $this->getSortedBooks($books);
    }

    private function getSortedBooks(array $books): array
    {
        $sortedBooks = $books;
        usort($sortedBooks, function (Book $book1, Book $book2) {
            return strcmp($book1->getName(), $book2->getName());
        });

        return $sortedBooks;
    }

    public function current()
    {
        return $this->books[$this->currentBookIndex];
    }

    public function next()
    {
        ++$this->currentBookIndex;
    }

    public function key()
    {
        return $this->currentBookIndex;
    }

    public function valid()
    {
        return isset($this->books[$this->currentBookIndex]);
    }

    public function rewind()
    {
        $this->currentBookIndex = 0;
    }
}
