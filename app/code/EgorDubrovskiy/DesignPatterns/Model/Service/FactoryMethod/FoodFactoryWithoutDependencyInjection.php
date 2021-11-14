<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Service\FactoryMethod;

use EgorDubrovskiy\DesignPatterns\Api\Data\FactoryMethod\FoodInterface;
use EgorDubrovskiy\DesignPatterns\Api\Service\FactoryMethod\FoodFactoryInterface;
use EgorDubrovskiy\DesignPatterns\Model\Data\FactoryMethod\Meat;
use EgorDubrovskiy\DesignPatterns\Model\Data\FactoryMethod\Salad;
use InvalidArgumentException;

/**
 * We could use Dependency Injection instead of 'new' for the class creation,
 * but we use this approach because we may not have Dependency Injection on other frameworks
 */
class FoodFactoryWithoutDependencyInjection implements FoodFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createFoodByName(string $foodName): FoodInterface
    {
        if ($foodName === self::FOOD_NAME_MEAT) {
            return new Meat();
        } elseif ($foodName === self::FOOD_NAME_SALAD) {
            return new Salad();
        }

        throw new InvalidArgumentException("A food with name: $foodName was not found");
    }
}
