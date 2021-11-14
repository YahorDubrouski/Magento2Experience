<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Strategy;

interface IntegerListSorterInterface
{
    public function getSortedList(array $list): array;
}
