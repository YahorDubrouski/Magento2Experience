<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Decorator;

use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\CheeseFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\PizzaInterface;

class CheesePizzaDecorator extends PizzaDecorator
{
    private CheeseFactory $cheeseFactory;

    public function __construct(
        PizzaInterface $pizza,
        CheeseFactory $cheeseFactory
    ) {
        parent::__construct($pizza);

        $this->cheeseFactory = $cheeseFactory;
    }

    public function addIngredients(array $ingredients): PizzaInterface
    {
        $cheese = $this->cheeseFactory->create();
        $ingredients[] = $cheese;

        return $this->pizza->addIngredients($ingredients);
    }
}
