<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Decorator;

use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\PizzaInterface;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\BaconFactory;

class BaconPizzaDecorator extends PizzaDecorator
{
    private BaconFactory $baconFactory;

    public function __construct(
        PizzaInterface $pizza,
        BaconFactory $baconFactory
    ) {
        parent::__construct($pizza);

        $this->baconFactory = $baconFactory;
    }

    public function addIngredients(array $ingredients): PizzaInterface
    {
        $bacon = $this->baconFactory->create();
        $ingredients[] = $bacon;

        return $this->pizza->addIngredients($ingredients);
    }
}
