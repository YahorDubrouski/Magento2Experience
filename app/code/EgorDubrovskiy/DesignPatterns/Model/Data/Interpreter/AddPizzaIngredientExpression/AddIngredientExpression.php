<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Interpreter\AddPizzaIngredientExpression;

use EgorDubrovskiy\DesignPatterns\Api\Data\Builder\FoodInterface;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\Cheese;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\CheeseFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\Bacon;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\BaconFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\PizzaInterface;
use Exception;

class AddIngredientExpression implements ExpressionInterface
{
    private const EXPRESSION_IDENTIFIER = 'Add:';

    private array $ingredientFactories;

    public function __construct(
        CheeseFactory $cheeseFactory,
        BaconFactory $baconFactory
    ) {
        $this->ingredientFactories = [
            Cheese::NAME => $cheeseFactory,
            Bacon::NAME => $baconFactory,
        ];
    }

    /**
     * @param PizzaInterface $pizza
     * @param string $expression
     * @throws Exception
     */
    public function execute(PizzaInterface $pizza, string $expression): void
    {
        $ingredient = $this->getIngredientByExpression($expression);
        $pizza->addIngredient($ingredient);
    }

    /**
     * @param string $expression
     * @return FoodInterface
     * @throws Exception
     */
    private function getIngredientByExpression(string $expression): FoodInterface
    {
        $ingredientName = $this->getIngredientNameFromExpression($expression);
        if (!isset($this->ingredientFactories[$ingredientName])) {
            throw new Exception('Ingredient Factory Was Not Found');
        }
        $ingredientFactory = $this->ingredientFactories[$ingredientName];

        return $ingredientFactory->create();
    }

    /**
     * @param string $expression
     * @return string
     * @throws Exception
     */
    private function getIngredientNameFromExpression(string $expression): string
    {
        $ingredientNameStartIndex = strpos($expression, self::EXPRESSION_IDENTIFIER)
            + strlen(self::EXPRESSION_IDENTIFIER);
        $ingredientNameEndIndex = strpos($expression, self::EXPRESSIONS_SEPARATOR)
            ? strpos($expression, self::EXPRESSIONS_SEPARATOR) - strlen(self::EXPRESSIONS_SEPARATOR)
            : strlen($expression) - 1;
        $ingredientNameLength = $ingredientNameEndIndex - $ingredientNameStartIndex + 1;
        $ingredientName = substr($expression, $ingredientNameStartIndex, $ingredientNameLength);

        if (!$ingredientName) {
            throw new Exception('Invalid Expression');
        }

        return $ingredientName;
    }

    public function hasExpressionInString(string $string): bool
    {
        return strpos($string, self::EXPRESSION_IDENTIFIER) !== false;
    }

    /**
     * @param string $string
     * @return string
     * @throws Exception
     */
    public function getExpressionFromString(string $string): string
    {
        $expressionStartIndex = strpos($string, self::EXPRESSION_IDENTIFIER);
        $expressionEndIndex = strpos($string, self::EXPRESSIONS_SEPARATOR)
            ? strpos($string, self::EXPRESSIONS_SEPARATOR) - strlen(self::EXPRESSIONS_SEPARATOR)
            : strlen($string) - 1;
        $expressionLength = $expressionEndIndex - $expressionStartIndex + 1;
        $expression = substr($string, $expressionStartIndex, $expressionLength);

        if (!$expression) {
            throw new Exception("Add Ingredient Expression was not found in the string: $string");
        }

        return $expression;
    }

    /**
     * @param string $string
     * @return string
     * @throws Exception
     */
    public function getStringWithoutExpression(string $string): string
    {
        $expression = $this->getExpressionFromString($string);

        return trim(str_replace($expression, '', $string));
    }
}
