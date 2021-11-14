<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food;

use EgorDubrovskiy\DesignPatterns\Api\Data\Builder\FoodInterface;

class Cheese extends AbstractFood implements FoodInterface
{
    public const NAME = 'Cheese';

    public function getFoodName(): string
    {
        return self::NAME;
    }
}
