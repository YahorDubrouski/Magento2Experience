<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Service\Facade\Calculator\Dneonline;

use EgorDubrovskiy\DesignPatterns\Model\Service\Facade\Calculator\CalculatorInterface;

class DneonlineCalculatorCache extends DneonlineCalculator implements CalculatorInterface
{
    private array $multiplicationCache = [];

    public function multiplyArguments(array $arguments): float
    {
        $cacheKey = serialize($arguments);
        if (!isset($this->multiplicationCache[$cacheKey])) {
            $this->multiplicationCache[$cacheKey] = parent::multiplyArguments($arguments);
        }

        return $this->multiplicationCache[$cacheKey];
    }
}
