<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Api\Data\Builder;

/**
 * Interface FoodInterface
 * @package EgorDubrovskiy\DesignPatterns\Api\Data\Builder
 * @api
 */
interface FoodInterface
{
    /**
     * @param float $amountOfGrams
     * @return FoodInterface
     */
    public function addGramsOfSalt(float $amountOfGrams): FoodInterface;

    /**
     * @param float $amountOfGrams
     * @return FoodInterface
     */
    public function addGramsOfSugar(float $amountOfGrams): FoodInterface;

    /**
     * @param float $amountOfGrams
     * @return FoodInterface
     */
    public function addGramsOfPaper(float $amountOfGrams): FoodInterface;

    /**
     * @return FoodInterface
     */
    public function addStandardOfPaperInGrams(): FoodInterface;

    /**
     * @return string
     */
    public function getFoodName(): string;
}
