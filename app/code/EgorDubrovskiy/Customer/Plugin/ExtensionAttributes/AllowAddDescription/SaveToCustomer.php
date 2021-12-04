<?php

declare(strict_types=1);

namespace EgorDubrovskiy\Customer\Plugin\ExtensionAttributes\AllowAddDescription;

use EgorDubrovskiy\Customer\Api\Repository\AllowAddDescriptionRepositoryInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Class SaveToCustomer
 * @package EgorDubrovskiy\Customer\Plugin\ExtensionAttributes\AllowAddDescription
 */
class SaveToCustomer
{
    /**
     * @var AllowAddDescriptionRepositoryInterface
     */
    private AllowAddDescriptionRepositoryInterface $allowAddDescriptionRepository;

    /**
     * SaveToCustomer constructor.
     * @param AllowAddDescriptionRepositoryInterface $allowAddDescriptionRepository
     */
    public function __construct(
        AllowAddDescriptionRepositoryInterface $allowAddDescriptionRepository
    ) {
        $this->allowAddDescriptionRepository = $allowAddDescriptionRepository;
    }

    /**
     * @param CustomerRepositoryInterface $subject
     * @param CustomerInterface $customer
     * @return CustomerInterface
     * @throws CouldNotSaveException
     */
    public function afterSave(CustomerRepositoryInterface $subject, $customer)
    {
        $extensionAttributes = $customer->getExtensionAttributes();
        $allowAddDescription = $extensionAttributes->getAllowAddDescription();
        if ($allowAddDescription) {
            $this->allowAddDescriptionRepository->save($allowAddDescription);
        }

        return $customer;
    }
}
