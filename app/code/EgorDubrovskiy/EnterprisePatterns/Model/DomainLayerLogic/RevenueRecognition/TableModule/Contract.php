<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\RevenueRecognition\TableModule;

use DateTime;
use InvalidArgumentException;
use Magento\Framework\Intl\DateTimeFactory;

class Contract
{
    private int $id;

    private int $userId;

    private int $productId;

    private Product $product;

    private ?DateTime $dateOfPurchase;

    private DateTimeFactory $dateTimeFactory;

    public function __construct(
        int $id,
        int $userId,
        int $productId,
        Product $product,
        DateTimeFactory $dateTimeFactory,
        string $dateOfPurchase = null
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->productId = $productId;
        $this->dateOfPurchase = $dateOfPurchase ? new DateTime($dateOfPurchase) : null;
        $this->product = $product;
        $this->dateTimeFactory = $dateTimeFactory;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getDateOfPurchase(): ?DateTime
    {
        return $this->dateOfPurchase;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function calculateRevenue(): float
    {
        if ($this->product->getType() === Product::PRODUCT_TYPE_WORD_PROCESSOR) {
            return $this->calculateRevenueForWordProcessor();
        } elseif ($this->product->getType() === Product::PRODUCT_TYPE_DATABASE) {
            return $this->calculateRevenueForDatabase();
        } elseif ($this->product->getType() === Product::PRODUCT_TYPE_EXCEL) {
            return $this->calculateRevenueForExcel();
        }

        throw new InvalidArgumentException('Unknown product type: ' . $this->product->getType());
    }

    private function calculateRevenueForWordProcessor(): float
    {
        return $this->product->getPrice();
    }

    private function calculateRevenueForDatabase(): float
    {
        $productPrice = $this->product->getPrice();
        $revenue = $productPrice / 3;
        $currentData = $this->dateTimeFactory->create();
        $amountOfDaysAfterPurchase = (int) $currentData->diff($this->getDateOfPurchase())->format("%a");
        if ($amountOfDaysAfterPurchase >= 30) {
            $revenue += $productPrice / 3;
        }
        if ($amountOfDaysAfterPurchase >= 60) {
            $revenue += $productPrice / 3;
        }

        return $revenue;
    }

    private function calculateRevenueForExcel(): float
    {
        $productPrice = $this->product->getPrice();
        $revenue = $productPrice / 3;
        $currentData = $this->dateTimeFactory->create();
        $amountOfDaysAfterPurchase = (int) $currentData->diff($this->getDateOfPurchase())->format("%a");
        if ($amountOfDaysAfterPurchase >= 60) {
            $revenue += $productPrice / 3;
        }
        if ($amountOfDaysAfterPurchase >= 90) {
            $revenue += $productPrice / 3;
        }

        return $revenue;
    }
}
