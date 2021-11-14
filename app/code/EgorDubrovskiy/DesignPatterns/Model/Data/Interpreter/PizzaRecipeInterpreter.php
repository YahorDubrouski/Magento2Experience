<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Interpreter;

use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\PizzaInterface;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\PizzaInterfaceFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Interpreter\AddPizzaIngredientExpression\AddIngredientExpression;
use EgorDubrovskiy\DesignPatterns\Model\Data\Interpreter\AddPizzaIngredientExpression\ExpressionInterface;
use Exception;

class PizzaRecipeInterpreter
{
    private PizzaInterfaceFactory $pizzaFactory;

    /**
     * @var ExpressionInterface[]
     */
    private array $makePizzaExpressions;

    public function __construct(
        PizzaInterfaceFactory $pizzaFactory,
        AddIngredientExpression $addIngredientExpression
    ) {
        $this->pizzaFactory = $pizzaFactory;
        $this->makePizzaExpressions = [
            $addIngredientExpression,
        ];
    }

    /**
     * @param string $stringExpression
     * @return PizzaInterface
     * @throws Exception
     */
    public function makePizzaByStringExpression(string $stringExpression): PizzaInterface
    {
        $pizza = $this->pizzaFactory->create();
        $notResolvedExpression = $stringExpression;
        while ($notResolvedExpression !== '') {
            foreach ($this->makePizzaExpressions as $makePizzaExpression) {
                if ($makePizzaExpression->hasExpressionInString($notResolvedExpression)) {
                    $currentExpressionString = $makePizzaExpression->getExpressionFromString($notResolvedExpression);
                    $makePizzaExpression->execute($pizza, $currentExpressionString);
                    $notResolvedExpression = $makePizzaExpression->getStringWithoutExpression($notResolvedExpression);
                }
            }
        }

        return $pizza;
    }
}
