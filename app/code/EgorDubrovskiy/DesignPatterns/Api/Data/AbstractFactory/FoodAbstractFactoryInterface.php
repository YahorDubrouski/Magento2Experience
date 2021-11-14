<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory;

use EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory\Dish\DessertInterface;
use EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory\Dish\SoupInterface;

/**
 * Interface FoodAbstractFactoryInterface
 * @package EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory
 */
interface FoodAbstractFactoryInterface
{
    /**
     * It would be better to create separate classes to configure the dishes,
     * but we use array just to save time
     * @param array $params
     * @return SoupInterface
     */
    public function createSoup(array $params): SoupInterface;

    /**
     * @param array $params
     * @return DessertInterface
     */
    public function createDessert(array $params): DessertInterface;
}
