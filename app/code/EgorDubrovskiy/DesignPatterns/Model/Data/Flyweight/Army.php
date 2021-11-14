<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Flyweight;

use EgorDubrovskiy\DesignPatterns\Model\Data\Flyweight\Solder\SolderInterface;

class Army
{
    /**
     * @var SolderInterface[]
     */
    protected array $solders = [];

    public function moveToCoordinates(int $x, int $y): self
    {
        foreach ($this->solders as $solder) {
            $solder->moveToCoordinates($x, $y);
        }

        return $this;
    }

    public function addSolder(SolderInterface $solder): self
    {
        $this->solders[] = $solder;

        return $this;
    }
}
