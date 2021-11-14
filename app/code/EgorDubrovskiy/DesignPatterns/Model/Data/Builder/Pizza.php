<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Builder;

use EgorDubrovskiy\DesignPatterns\Api\Data\Builder\FoodInterface;

class Pizza implements PizzaInterface
{
    /**
     * @var FoodInterface[]
     */
    private array $ingredients = [];

    public function addIngredient(FoodInterface $ingredient): PizzaInterface
    {
        $this->ingredients[] = $ingredient;

        return $this;
    }

    public function addIngredients(array $ingredients): PizzaInterface
    {
        foreach ($ingredients as $ingredient) {
            $this->addIngredient($ingredient);
        }

        return $this;
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }
}
