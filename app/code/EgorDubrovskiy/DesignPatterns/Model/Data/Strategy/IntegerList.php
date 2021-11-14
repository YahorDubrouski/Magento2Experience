<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Strategy;

use EgorDubrovskiy\DesignPatterns\Model\Data\Strategy\Sorter\BubbleSorter;
use EgorDubrovskiy\DesignPatterns\Model\Data\Strategy\Sorter\QuickSorter;

class IntegerList
{
    const AMOUNT_OF_ITEMS_FOR_QUICK_SORT = 10000;
    const AMOUNT_OF_ITEMS_FOR_BUBBLE_SORT = 10;

    private BubbleSorter $bubbleListSorter;

    private QuickSorter $quickListSorter;

    public function __construct(
        BubbleSorter $bubbleListSorter,
        QuickSorter $quickListSorter
    ) {
        $this->bubbleListSorter = $bubbleListSorter;
        $this->quickListSorter = $quickListSorter;
    }

    public function getSortedList(array $list): array
    {
        if (count($list) >= self::AMOUNT_OF_ITEMS_FOR_QUICK_SORT) {
            return $this->quickListSorter->getSortedList($list);
        } else {
            return $this->bubbleListSorter->getSortedList($list);
        }
    }
}
