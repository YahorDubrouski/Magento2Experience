<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Command;

use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\Bacon;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\Cheese;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\PizzaInterface;
use EgorDubrovskiy\DesignPatterns\Model\Data\Command\AddIngredientToPizza\AddBaconCommandFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Command\AddIngredientToPizza\AddCheeseCommandFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Command\AddIngredientToPizza\AddIngredientCommandInterface;
use LogicException;

class PizzaCook
{
    /** @var AddIngredientCommandInterface[] */
    private array $addIngredientCommands = [];

    private array $addIngredientCommandsPool = [];

    private PizzaInterface $pizza;

    public function __construct(
        PizzaInterface $pizza,
        AddCheeseCommandFactory $addCheeseCommandFactory,
        AddBaconCommandFactory $addBaconCommandFactory
    ) {
        $this->pizza = $pizza;
        $this->addIngredientCommandsPool = [
            Cheese::NAME => $addCheeseCommandFactory->create(['pizza' => $pizza]),
            Bacon::NAME => $addBaconCommandFactory->create(['pizza' => $pizza]),
        ];
    }

    public function addIngredientToRecipeByName(string $ingredientName): PizzaCook
    {
        $this->addIngredientCommands[] = $this->getCommandByIngredientName($ingredientName);

        return $this;
    }

    private function getCommandByIngredientName(string $ingredientName): AddIngredientCommandInterface
    {
        if (isset($this->addIngredientCommandsPool[$ingredientName])) {
            return $this->addIngredientCommandsPool[$ingredientName];
        }

        throw new LogicException('Add Ingredient Command was not found in the pool');
    }

    public function makePizza(): PizzaInterface
    {
        foreach ($this->addIngredientCommands as $addIngredientCommand) {
            $addIngredientCommand->execute();
        }

        return $this->pizza;
    }
}
