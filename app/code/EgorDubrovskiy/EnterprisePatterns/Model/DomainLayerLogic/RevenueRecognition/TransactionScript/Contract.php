<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\RevenueRecognition\TransactionScript;

use DateTime;

class Contract
{
    private int $id;

    private int $userId;

    private int $productId;

    private ?DateTime $dateOfPurchase;

    private Product $product;

    public function __construct(
        int $id,
        int $userId,
        int $productId,
        Product $product,
        string $dateOfPurchase = null
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->productId = $productId;
        $this->dateOfPurchase = $dateOfPurchase ? new DateTime($dateOfPurchase) : null;
        $this->product = $product;
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
}
