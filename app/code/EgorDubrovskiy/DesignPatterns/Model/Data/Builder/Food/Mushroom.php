<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food;

use EgorDubrovskiy\DesignPatterns\Api\Data\Builder\FoodInterface;

class Mushroom extends AbstractFood implements FoodInterface
{
    public const NAME = 'Mushroom';

    public function getFoodName(): string
    {
        return self::NAME;
    }
}
