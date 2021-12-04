<?php

declare(strict_types=1);

namespace EgorDubrovskiy\Customer\Api\Repository;

use EgorDubrovskiy\Customer\Api\Data\AllowAddDescriptionInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface AllowAddDescriptionRepositoryInterface
 * @package EgorDubrovskiy\Customer\Api\Repository
 * @api
 */
interface AllowAddDescriptionRepositoryInterface
{
    /**
     * @param AllowAddDescriptionInterface $allowAddDescription
     * @return AllowAddDescriptionInterface
     * @throws CouldNotSaveException
     */
    public function save(AllowAddDescriptionInterface $allowAddDescription): AllowAddDescriptionInterface;

    /**
     * @param string $customerEmail
     * @return AllowAddDescriptionInterface
     * @throws NoSuchEntityException
     */
    public function getByCustomerEmail(string $customerEmail): AllowAddDescriptionInterface;
}
