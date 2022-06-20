<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\RevenueRecognition;

use InvalidArgumentException;
use EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\RevenueRecognition\TransactionScript\RecognizedRevenueCalculator
    as TransactionScriptCalculator;
use Magento\Framework\Exception\NoSuchEntityException;
use EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\RevenueRecognition\TableModule\ContractRepository
    as TableModuleContractRepository;

class RecognizedRevenueCalculator
{
    public const CALCULATOR_STRATEGY_TRANSACTION_SCRIPT = 'transaction_script';
    public const CALCULATOR_STRATEGY_TABLE_MODULE = 'table_module';

    private TransactionScriptCalculator $transactionScriptCalculator;

    private TableModuleContractRepository $tableModuleContractRepository;

    public function __construct(
        TransactionScriptCalculator $transactionScriptCalculator,
        TableModuleContractRepository $tableModuleContractRepository
    ) {
        $this->transactionScriptCalculator = $transactionScriptCalculator;
        $this->tableModuleContractRepository = $tableModuleContractRepository;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function calculate(string $strategy, int $contractId): float
    {
        if ($strategy === self::CALCULATOR_STRATEGY_TRANSACTION_SCRIPT) {
            return $this->transactionScriptCalculator->calculateForContract($contractId);
        } elseif ($strategy === self::CALCULATOR_STRATEGY_TABLE_MODULE) {
            return $this->tableModuleContractRepository->getById($contractId)->calculateRevenue();
        }

        throw new InvalidArgumentException("Unknown strategy: $strategy");
    }
}
