<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Builder;

use EgorDubrovskiy\DesignPatterns\Api\Data\Builder\FoodInterface;

interface PizzaInterface
{
    public function addIngredient(FoodInterface $ingredient): PizzaInterface;

    public function addIngredients(array $ingredients): PizzaInterface;

    public function getIngredients(): array;
}
