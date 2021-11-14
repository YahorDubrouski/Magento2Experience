<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Flyweight\Unit;

use EgorDubrovskiy\DesignPatterns\Model\Data\Flyweight\Texture\UniformTexture;

class CavalryUnit extends Unit
{
    private UniformTexture $uniformTexture;

    public function __construct(UniformTexture $uniformTexture)
    {
        $this->uniformTexture = $uniformTexture;
    }
}
