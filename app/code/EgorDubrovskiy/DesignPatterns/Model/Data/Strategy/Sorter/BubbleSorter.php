<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Strategy\Sorter;

use EgorDubrovskiy\DesignPatterns\Model\Data\Strategy\IntegerListSorterInterface;

class BubbleSorter implements IntegerListSorterInterface
{
    public function getSortedList(array $list): array
    {
        $sortedList = $list;
        $listSize = sizeof($sortedList) - 1;
        for ($i = $listSize; $i >= 0; $i--) {
            for ($j = 0; $j <= ($i - 1); $j++) {
                if ($sortedList[$j] > $sortedList[$j + 1]) {
                    $k = $sortedList[$j];
                    $sortedList[$j] = $sortedList[$j + 1];
                    $sortedList[$j + 1] = $k;
                }
            }
        }

        return $sortedList;
    }
}
