<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Flyweight\Unit;

use EgorDubrovskiy\DesignPatterns\Model\Data\Flyweight\Texture\TankGunTexture;

class TankUnit extends Unit
{
    private TankGunTexture $tankGunTexture;

    public function __construct(TankGunTexture $tankGunTexture)
    {
        $this->tankGunTexture = $tankGunTexture;
    }
}
