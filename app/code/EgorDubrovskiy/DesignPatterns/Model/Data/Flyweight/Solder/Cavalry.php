<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Flyweight\Solder;

use EgorDubrovskiy\DesignPatterns\Model\Data\Flyweight\Unit\CavalryUnit;

class Cavalry implements SolderInterface
{
    private int $x = 0;

    private int $y = 0;

    private CavalryUnit $unit;

    public function __construct(CavalryUnit $unit)
    {
        $this->unit = $unit;
    }

    public function moveToCoordinates(int $x, int $y): SolderInterface
    {
        $this->x = $x;
        $this->y = $y;

        return $this;
    }
}
