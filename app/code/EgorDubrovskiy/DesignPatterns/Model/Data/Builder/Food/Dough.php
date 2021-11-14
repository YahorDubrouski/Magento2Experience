<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food;

use EgorDubrovskiy\DesignPatterns\Api\Data\Builder\FoodInterface;

class Dough extends AbstractFood implements FoodInterface
{
    public const NAME = 'Dough';

    public function getFoodName(): string
    {
        return self::NAME;
    }
}
