<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Iterator;

use EgorDubrovskiy\DesignPatterns\Model\Data\Iterator\BookList\Iterator\BooksSortedByNameIteratorFactory;
use Iterator;
use EgorDubrovskiy\DesignPatterns\Model\Data\Iterator\BookList\Iterator\BooksSortedByAuthorNameIteratorFactory;

class BookList
{
    private array $books = [];

    private BooksSortedByNameIteratorFactory $booksSortedByNameIteratorFactory;

    private BooksSortedByAuthorNameIteratorFactory $booksSortedByAuthorNameIteratorFactory;

    public function __construct(
        BooksSortedByNameIteratorFactory $booksSortedByNameIteratorFactory,
        BooksSortedByAuthorNameIteratorFactory $booksSortedByAuthorNameIteratorFactory
    ) {
        $this->booksSortedByNameIteratorFactory = $booksSortedByNameIteratorFactory;
        $this->booksSortedByAuthorNameIteratorFactory = $booksSortedByAuthorNameIteratorFactory;
    }

    public function addBook(Book $book): BookList
    {
        $this->books[] = $book;

        return $this;
    }

    public function getBooksSortedByName(): Iterator
    {
        return $this->booksSortedByNameIteratorFactory->create(['books' => $this->books]);
    }

    public function getBooksSortedByAuthorName(): Iterator
    {
        return $this->booksSortedByAuthorNameIteratorFactory->create(['books' => $this->books]);
    }
}
