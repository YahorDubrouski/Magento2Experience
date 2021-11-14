<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Strategy\Sorter;

use EgorDubrovskiy\DesignPatterns\Model\Data\Strategy\IntegerListSorterInterface;

class QuickSorter implements IntegerListSorterInterface
{
    public function getSortedList(array $list): array
    {
        $listSize = count($list);
        if ($listSize <= 1) {
            return $list;
        }

        $firstValue = $list[0];
        $leftList = [];
        $rightList = [];
        for ($i = 1; $i < $listSize; $i++) {
            if ($list[$i] <= $firstValue) {
                $leftList[] = $list[$i];
            } else {
                $rightList[] = $list[$i];
            }
        }

        $leftList = $this->getSortedList($leftList);
        $rightList = $this->getSortedList($rightList);

        return array_merge($leftList, [$firstValue], $rightList);
    }
}
