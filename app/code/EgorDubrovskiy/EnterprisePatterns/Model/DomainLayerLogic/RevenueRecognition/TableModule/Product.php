<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\RevenueRecognition\TableModule;

class Product
{
    public const PRODUCT_TYPE_WORD_PROCESSOR = 'word_processor';
    public const PRODUCT_TYPE_DATABASE = 'database';
    public const PRODUCT_TYPE_EXCEL = 'excel';

    private int $id;

    private float $price;

    private string $type;

    public function __construct(
        int $id,
        float $price,
        string $type
    ) {
        $this->id = $id;
        $this->price = $price;
        $this->type = $type;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
