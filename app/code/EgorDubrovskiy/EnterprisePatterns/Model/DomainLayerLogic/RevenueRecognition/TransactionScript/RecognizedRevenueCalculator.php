<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\RevenueRecognition\TransactionScript;

use InvalidArgumentException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Intl\DateTimeFactory;

class RecognizedRevenueCalculator
{
    private DateTimeFactory $dateTimeFactory;

    private ContractRepository $contractRepository;

    public function __construct(
        DateTimeFactory $dateTimeFactory,
        ContractRepository $contractRepository
    ) {
        $this->dateTimeFactory = $dateTimeFactory;
        $this->contractRepository = $contractRepository;
    }

    /**
     * @throws InvalidArgumentException
     * @throws NoSuchEntityException
     */
    public function calculateForContract(int $contractId): float
    {
        $contract = $this->contractRepository->getById($contractId);
        $product = $contract->getProduct();

        if ($product->getType() === Product::PRODUCT_TYPE_WORD_PROCESSOR) {
            return $this->calculateForWordProcessorContract($contract);
        } elseif ($product->getType() === Product::PRODUCT_TYPE_DATABASE) {
            return $this->calculateForDatabaseContract($contract);
        } elseif ($product->getType() === Product::PRODUCT_TYPE_EXCEL) {
            return $this->calculateForExcelContract($contract);
        }

        throw new InvalidArgumentException('Unknown product type: ' . $product->getType());
    }

    public function calculateForWordProcessorContract(Contract $contract): float
    {
        return $contract->getProduct()->getPrice();
    }

    public function calculateForDatabaseContract(Contract $contract): float
    {
        $productPrice = $contract->getProduct()->getPrice();
        $revenue = $productPrice / 3;
        $currentData = $this->dateTimeFactory->create();
        $amountOfDaysAfterPurchase = (int) $currentData->diff($contract->getDateOfPurchase())->format("%a");
        if ($amountOfDaysAfterPurchase >= 30) {
            $revenue += $productPrice / 3;
        }
        if ($amountOfDaysAfterPurchase >= 60) {
            $revenue += $productPrice / 3;
        }

        return $revenue;
    }

    public function calculateForExcelContract(Contract $contract): float
    {
        $productPrice = $contract->getProduct()->getPrice();
        $revenue = $productPrice / 3;
        $currentData = $this->dateTimeFactory->create();
        $amountOfDaysAfterPurchase = (int) $currentData->diff($contract->getDateOfPurchase())->format("%a");
        if ($amountOfDaysAfterPurchase >= 60) {
            $revenue += $productPrice / 3;
        }
        if ($amountOfDaysAfterPurchase >= 90) {
            $revenue += $productPrice / 3;
        }

        return $revenue;
    }
}
