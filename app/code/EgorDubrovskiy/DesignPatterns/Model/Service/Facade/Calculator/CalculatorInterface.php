<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Service\Facade\Calculator;

interface CalculatorInterface
{
    /**
     * @param float|int[] $arguments
     * @return float
     */
    public function multiplyArguments(array $arguments): float;
}
