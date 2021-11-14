<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Composite;

use EgorDubrovskiy\DesignPatterns\Api\Data\Composite\TreeElementInterface;

class Leaf implements TreeElementInterface
{
    private int $numberOfInsects = 0;

    public function incrementNumberOfInsects(): TreeElementInterface
    {
        $this->numberOfInsects++;

        return $this;
    }

    public function decrementNumberOfInsects(): TreeElementInterface
    {
        $this->numberOfInsects--;

        return $this;
    }
}
