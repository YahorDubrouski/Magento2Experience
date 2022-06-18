<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\RevenueRecognition;

use DateTime;
use InvalidArgumentException;

class ProductRevenueStrategyCalculator
{
    public const CALCULATOR_STRATEGY_TRANSACTION_SCRIPT = 'transaction_script';

    private TransactionScriptProductRevenueCalculator $transactionScriptCalculator;

    public function __construct(
        TransactionScriptProductRevenueCalculator $transactionScriptCalculator
    ) {
        $this->transactionScriptCalculator = $transactionScriptCalculator;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function calculate(string $strategy, string $productType, DateTime $dateOfPurchase): float
    {
        if ($strategy === self::CALCULATOR_STRATEGY_TRANSACTION_SCRIPT) {
            return $this->transactionScriptCalculator->calculate($productType, $dateOfPurchase);
        }

        throw new InvalidArgumentException("Unknown strategy: $strategy");
    }
}
