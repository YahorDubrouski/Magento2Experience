<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Api\Data\FactoryMethod;

/**
 * Interface FoodInterface
 * @package EgorDubrovskiy\DesignPatterns\Api\Data\FactoryMethod
 * @api
 */
interface FoodInterface
{
    /**
     * @return string
     */
    public function getName(): string;
}
