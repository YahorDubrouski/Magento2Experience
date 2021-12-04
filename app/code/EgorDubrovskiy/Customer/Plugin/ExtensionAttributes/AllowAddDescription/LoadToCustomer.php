<?php

declare(strict_types=1);

namespace EgorDubrovskiy\Customer\Plugin\ExtensionAttributes\AllowAddDescription;

use EgorDubrovskiy\Customer\Api\Repository\AllowAddDescriptionRepositoryInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Api\Data\CustomerSearchResultsInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class LoadToCustomer
 * @package EgorDubrovskiy\Customer\Plugin\ExtensionAttributes\AllowAddDescription
 */
class LoadToCustomer
{
    /**
     * @var AllowAddDescriptionRepositoryInterface
     */
    private AllowAddDescriptionRepositoryInterface $allowAddDescriptionRepository;

    /**
     * LoadToCustomer constructor.
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
     */
    public function afterGet(CustomerRepositoryInterface $subject, $customer)
    {
        $this->loadAllowAddDescriptionToCustomer($customer);

        return $customer;
    }

    /**
     * @param CustomerRepositoryInterface $subject
     * @param CustomerInterface $customer
     * @return CustomerInterface
     */
    public function afterGetById(CustomerRepositoryInterface $subject, $customer)
    {
        $this->loadAllowAddDescriptionToCustomer($customer);

        return $customer;
    }

    /**
     * @param CustomerInterface $customer
     */
    private function loadAllowAddDescriptionToCustomer(CustomerInterface $customer): void
    {
        try {
            $extensionAttributes = $customer->getExtensionAttributes();
            $allowAddDescription = $this->allowAddDescriptionRepository->getByCustomerEmail($customer->getEmail());
            $extensionAttributes->setAllowAddDescription($allowAddDescription);
            $customer->setExtensionAttributes($extensionAttributes);
        } catch (NoSuchEntityException $noSuchEntityException) {
            return;
        }
    }

    /**
     * @param CustomerRepositoryInterface $subject
     * @param CustomerSearchResultsInterface $searchResults
     */
    public function afterGetList(CustomerRepositoryInterface $subject, CustomerSearchResultsInterface $searchResults)
    {
        foreach ($searchResults->getItems() as $customer) {
            $this->loadAllowAddDescriptionToCustomer($customer);
        }
    }
}
