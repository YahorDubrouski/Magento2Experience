<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory\Dish;

/**
 * Interface SoupInterface
 * @package EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory\Dish
 * @api
 */
interface SoupInterface
{
    /**
     * @param float $amountOfGrams
     * @return SoupInterface
     */
    public function addGramsOfSalt(float $amountOfGrams): SoupInterface;
}
