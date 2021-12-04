<?php

declare(strict_types=1);

namespace EgorDubrovskiy\Customer\Model\Data;

use EgorDubrovskiy\Customer\Api\Data\AllowAddDescriptionInterface;
use Magento\Framework\Api\CustomAttributesDataInterface;
use EgorDubrovskiy\Customer\Api\Data\AllowAddDescriptionExtensionInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class AllowAddDescription
 * @package EgorDubrovskiy\Customer\Model\Data
 */
class AllowAddDescription extends AbstractExtensibleModel implements AllowAddDescriptionInterface
{
    /**
     * @var string
     */
    protected $_idFieldName = AllowAddDescriptionInterface::DATA_KEY_ENTITY_ID;

    /**
     * @return \EgorDubrovskiy\Customer\Api\Data\AllowAddDescriptionExtensionInterface
     */
    public function getExtensionAttributes(): AllowAddDescriptionExtensionInterface
    {
        if (!$this->_getExtensionAttributes()) {
            $extensionAttributes = $this->extensionAttributesFactory->create(AllowAddDescription::class);
            $this->setExtensionAttributes($extensionAttributes);
        }

        return $this->_getExtensionAttributes();
    }

    /**
     * @param \EgorDubrovskiy\Customer\Api\Data\AllowAddDescriptionExtensionInterface $extensionAttributes
     * @return AllowAddDescriptionInterface
     */
    public function setExtensionAttributes(
        AllowAddDescriptionExtensionInterface $extensionAttributes
    ): AllowAddDescriptionInterface {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * @inheritdoc
     */
    public function getCustomerEmail(): string
    {
        return (string) $this->getDataByKey(self::DATA_KEY_CUSTOMER_EMAIl);
    }

    /**
     * @inheritdoc
     */
    public function setCustomerEmail(?string $email): CustomAttributesDataInterface
    {
        return $this->setData(self::DATA_KEY_CUSTOMER_EMAIl, $email);
    }

    /**
     * @inheritdoc
     */
    public function getAllowAddDescription(): bool
    {
        return (bool) $this->getDataByKey(self::DATA_KEY_ALLOW_ADD_DESCRIPTION);
    }

    /**
     * @inheritdoc
     */
    public function setAllowAddDescription(?bool $allowAddDescription): CustomAttributesDataInterface
    {
        return $this->setData(self::DATA_KEY_ALLOW_ADD_DESCRIPTION, $allowAddDescription);
    }
}
