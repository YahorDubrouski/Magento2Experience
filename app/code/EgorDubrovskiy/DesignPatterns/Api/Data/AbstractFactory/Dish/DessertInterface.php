<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory\Dish;

/**
 * Interface DessertInterface
 * @package EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory\Dish
 * @api
 */
interface DessertInterface
{
    /**
     * @param float $amountOfGrams
     * @return DessertInterface
     */
    public function addGramsOfSugar(float $amountOfGrams): DessertInterface;
}
