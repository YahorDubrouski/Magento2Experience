<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Flyweight\Solder;

interface SolderInterface
{
    public function moveToCoordinates(int $x, int $y): SolderInterface;
}
