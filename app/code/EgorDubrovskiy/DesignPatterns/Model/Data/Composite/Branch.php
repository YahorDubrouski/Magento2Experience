<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Composite;

use EgorDubrovskiy\DesignPatterns\Api\Data\Composite\TreeElementInterface;

class Branch implements TreeElementInterface
{
    private int $numberOfInsects = 0;

    /**
     * @var TreeElementInterface[]
     */
    private array $childElements = [];

    public function incrementNumberOfInsects(): TreeElementInterface
    {
        $this->numberOfInsects++;

        foreach ($this->childElements as $childElement) {
            $childElement->incrementNumberOfInsects();
        }

        return $this;
    }

    public function decrementNumberOfInsects(): TreeElementInterface
    {
        $this->numberOfInsects--;

        foreach ($this->childElements as $childElement) {
            $childElement->decrementNumberOfInsects();
        }

        return $this;
    }

    public function addChildElement(TreeElementInterface $treeElement): TreeElementInterface
    {
        $this->childElements[] = $treeElement;

        return $this;
    }
}
