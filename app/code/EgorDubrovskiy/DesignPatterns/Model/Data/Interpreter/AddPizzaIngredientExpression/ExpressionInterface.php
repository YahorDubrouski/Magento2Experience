<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Interpreter\AddPizzaIngredientExpression;

use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\PizzaInterface;

interface ExpressionInterface
{
    public const EXPRESSIONS_SEPARATOR = ' ';

    public function execute(PizzaInterface $pizza, string $expression): void;

    public function hasExpressionInString(string $string): bool;

    public function getExpressionFromString(string $string): string;

    public function getStringWithoutExpression(string $string): string;
}
