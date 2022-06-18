<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\RevenueRecognition;

use DateTime;
use InvalidArgumentException;
use Magento\Framework\Intl\DateTimeFactory;

class TransactionScriptProductRevenueCalculator
{
    public const PRODUCT_TYPE_WORD_PROCESSOR = 'word_processor';
    public const WORD_PROCESSOR_PRODUCT_PRICE = 10;

    public const PRODUCT_TYPE_DATABASE = 'database';
    public const DATABASE_PRODUCT_PRICE = 15;

    public const PRODUCT_TYPE_EXCEL = 'excel';
    public const EXCEL_PRODUCT_PRICE = 9;

    private DateTimeFactory $dateTimeFactory;

    public function __construct(
        DateTimeFactory $dateTimeFactory
    ) {
        $this->dateTimeFactory = $dateTimeFactory;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function calculate(string $productType, DateTime $dateOfPurchase): float
    {
        if ($productType === self::PRODUCT_TYPE_WORD_PROCESSOR) {
            return $this->calculateForWordProcessor();
        } elseif ($productType === self::PRODUCT_TYPE_DATABASE) {
            return $this->calculateForDatabase($dateOfPurchase);
        } elseif ($productType === self::PRODUCT_TYPE_EXCEL) {
            return $this->calculateForExcel($dateOfPurchase);
        }

        throw new InvalidArgumentException("Unknown product type: $productType");
    }

    public function calculateForWordProcessor(): float
    {
        return self::WORD_PROCESSOR_PRODUCT_PRICE;
    }

    public function calculateForDatabase(DateTime $dateOfPurchase): float
    {
        $revenue = (float) self::DATABASE_PRODUCT_PRICE / 3;
        $currentData = $this->dateTimeFactory->create();
        $amountOfDaysAfterPurchase = (int) $currentData->diff($dateOfPurchase)->format("%a");
        if ($amountOfDaysAfterPurchase >= 30) {
            $revenue += self::DATABASE_PRODUCT_PRICE / 3;
        }
        if ($amountOfDaysAfterPurchase >= 60) {
            $revenue += self::DATABASE_PRODUCT_PRICE / 3;
        }

        return $revenue;
    }

    public function calculateForExcel(DateTime $dateOfPurchase): float
    {
        $revenue = (float) self::EXCEL_PRODUCT_PRICE / 3;
        $currentData = $this->dateTimeFactory->create();
        $amountOfDaysAfterPurchase = (int) $currentData->diff($dateOfPurchase)->format("%a");
        if ($amountOfDaysAfterPurchase >= 60) {
            $revenue += self::EXCEL_PRODUCT_PRICE / 3;
        }
        if ($amountOfDaysAfterPurchase >= 90) {
            $revenue += self::EXCEL_PRODUCT_PRICE / 3;
        }

        return $revenue;
    }
}
