<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Flyweight\Solder;

use EgorDubrovskiy\DesignPatterns\Model\Data\Flyweight\Unit\TankUnit;

class Tank implements SolderInterface
{
    private int $x = 0;

    private int $y = 0;

    private TankUnit $unit;

    public function __construct(TankUnit $unit)
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
