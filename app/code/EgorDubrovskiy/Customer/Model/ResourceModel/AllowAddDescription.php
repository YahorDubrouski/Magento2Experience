<?php

declare(strict_types=1);

namespace EgorDubrovskiy\Customer\Model\ResourceModel;

use EgorDubrovskiy\Customer\Api\Data\AllowAddDescriptionInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class AllowAddDescription
 * @package EgorDubrovskiy\Customer\Model\ResourceModel
 */
class AllowAddDescription extends AbstractDb
{
    public const TABLE_NAME = 'customer_allow_add_description';

    /**
     * @var string
     */
    protected $_idFieldName = AllowAddDescriptionInterface::DATA_KEY_ENTITY_ID;

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, $this->_idFieldName);
    }
}
