<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\RevenueRecognition\TransactionScript;

use Magento\Framework\Exception\NoSuchEntityException;

class ContractRepository
{
    private array $contracts;

    public function __construct(array $contracts)
    {
        $this->contracts = $contracts;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getById(int $contactId): Contract
    {
        /** @var Contract $contract */
        foreach ($this->contracts as $contract) {
            if ($contract->getId() === $contactId) {
                return $contract;
            }
        }

        throw new NoSuchEntityException(__("Contract with ID: $contactId was not found"));
    }
}
