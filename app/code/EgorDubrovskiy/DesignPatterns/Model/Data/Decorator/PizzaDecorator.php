<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Decorator;

use EgorDubrovskiy\DesignPatterns\Api\Data\Builder\FoodInterface;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\PizzaInterface;

class PizzaDecorator implements PizzaInterface
{
    protected PizzaInterface $pizza;

    public function __construct(PizzaInterface $pizza)
    {
        $this->pizza = $pizza;
    }

    public function addIngredients(array $ingredients): PizzaInterface
    {
        return $this->pizza->addIngredients($ingredients);
    }

    public function addIngredient(FoodInterface $ingredient): PizzaInterface
    {
        return $this->pizza->addIngredient($ingredient);
    }

    public function getIngredients(): array
    {
        return $this->pizza->getIngredients();
    }
}
