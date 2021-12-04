<?php

declare(strict_types=1);

namespace EgorDubrovskiy\Customer\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

/**
 * Interface AllowAddDescriptionInterface
 * @package EgorDubrovskiy\Customer\Api\Data
 * @api
 */
interface AllowAddDescriptionInterface extends CustomAttributesDataInterface
{
    public const DATA_KEY_ENTITY_ID = 'entity_id';
    public const DATA_KEY_CUSTOMER_EMAIl = 'customer_email';
    public const DATA_KEY_ALLOW_ADD_DESCRIPTION = 'allow_add_description';

    /**
     * @return \EgorDubrovskiy\Customer\Api\Data\AllowAddDescriptionExtensionInterface
     */
    public function getExtensionAttributes(): AllowAddDescriptionExtensionInterface;

    /**
     * @param \EgorDubrovskiy\Customer\Api\Data\AllowAddDescriptionExtensionInterface $extensionAttributes
     * @return AllowAddDescriptionInterface
     */
    public function setExtensionAttributes(
        AllowAddDescriptionExtensionInterface $extensionAttributes
    ): AllowAddDescriptionInterface;

    /**
     * @return string
     */
    public function getCustomerEmail(): string;

    /**
     * @param string|null $email
     * @return CustomAttributesDataInterface
     */
    public function setCustomerEmail(?string $email): CustomAttributesDataInterface;

    /**
     * @return bool
     */
    public function getAllowAddDescription(): bool;

    /**
     * @param bool|null $allowAddDescription
     * @return CustomAttributesDataInterface
     */
    public function setAllowAddDescription(?bool $allowAddDescription): CustomAttributesDataInterface;
}
