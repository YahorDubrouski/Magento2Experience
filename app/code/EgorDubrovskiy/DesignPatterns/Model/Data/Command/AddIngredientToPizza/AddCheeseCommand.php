<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Command\AddIngredientToPizza;

use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\CheeseFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\PizzaInterface;

class AddCheeseCommand implements AddIngredientCommandInterface
{
    private const AMOUNT_GRAMS_OF_SALT = 10;

    private PizzaInterface $pizza;

    private CheeseFactory $cheeseFactory;

    public function __construct(
        PizzaInterface $pizza,
        CheeseFactory $cheeseFactory
    ) {
        $this->pizza = $pizza;
        $this->cheeseFactory = $cheeseFactory;
    }

    public function execute(): void
    {
        $cheese = $this->cheeseFactory->create();
        $cheese->addGramsOfSalt(self::AMOUNT_GRAMS_OF_SALT);

        $this->pizza->addIngredient($cheese);
    }
}
