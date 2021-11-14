<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Api\Service\FactoryMethod;

use EgorDubrovskiy\DesignPatterns\Api\Data\FactoryMethod\FoodInterface;
use InvalidArgumentException;

/**
 * Interface FoodFactoryInterface
 * @package EgorDubrovskiy\DesignPatterns\Api\Service\FactoryMethod
 * @api
 */
interface FoodFactoryInterface
{
    public const FOOD_NAME_MEAT = 'Meat';
    public const FOOD_NAME_SALAD = 'Salad';

    /**
     * @param string $foodName
     * @return FoodInterface
     * @throws InvalidArgumentException
     */
    public function createFoodByName(string $foodName): FoodInterface;
}
