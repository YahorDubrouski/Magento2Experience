<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Command\AddIngredientToPizza;

use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\BaconFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\PizzaInterface;

class AddBaconCommand implements AddIngredientCommandInterface
{
    private const AMOUNT_GRAMS_OF_SUGAR = 1.5;

    private PizzaInterface $pizza;

    private BaconFactory $baconFactory;

    public function __construct(
        PizzaInterface $pizza,
        BaconFactory $baconFactory
    ) {
        $this->pizza = $pizza;
        $this->baconFactory = $baconFactory;
    }

    public function execute(): void
    {
        $bacon = $this->baconFactory->create();
        $bacon->addGramsOfSugar(self::AMOUNT_GRAMS_OF_SUGAR);

        $this->pizza->addIngredient($bacon);
    }
}
