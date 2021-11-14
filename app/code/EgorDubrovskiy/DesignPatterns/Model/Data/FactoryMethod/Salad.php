<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\FactoryMethod;

use EgorDubrovskiy\DesignPatterns\Api\Data\FactoryMethod\FoodInterface;

class Salad implements FoodInterface
{
    /**
     * In real life, we get the name from a database
     * We use this constant just for make an example faster
     */
    private const NAME = 'Salad';

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return self::NAME;
    }
}
