<?php

declare(strict_types=1);

namespace EgorDubrovskiy\Customer\Model\Repository;

use EgorDubrovskiy\Customer\Api\Data\AllowAddDescriptionInterface;
use EgorDubrovskiy\Customer\Api\Repository\AllowAddDescriptionRepositoryInterface;
use EgorDubrovskiy\Customer\Model\ResourceModel\AllowAddDescription as AllowAddDescriptionResource;
use EgorDubrovskiy\Customer\Model\Data\AllowAddDescriptionFactory as AllowAddDescriptionModelFactory;
use EgorDubrovskiy\Customer\Model\Data\AllowAddDescription as AllowAddDescriptionModel;
use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class AllowAddDescriptionRepository
 * @package EgorDubrovskiy\Customer\Model\Repository
 */
class AllowAddDescriptionRepository implements AllowAddDescriptionRepositoryInterface
{
    /**
     * @var AllowAddDescriptionResource
     */
    private AllowAddDescriptionResource $resource;

    /**
     * @var AllowAddDescriptionModelFactory
     */
    private AllowAddDescriptionModelFactory $modelFactory;

    /**
     * AllowAddDescriptionRepository constructor.
     * @param AllowAddDescriptionResource $resource
     * @param AllowAddDescriptionModelFactory $modelFactory
     */
    public function __construct(
        AllowAddDescriptionResource $resource,
        AllowAddDescriptionModelFactory $modelFactory
    ) {
        $this->resource = $resource;
        $this->modelFactory = $modelFactory;
    }

    /**
     * @inheritdoc
     */
    public function save(AllowAddDescriptionInterface $allowAddDescription): AllowAddDescriptionInterface
    {
        try {
            $this->resource->save($allowAddDescription);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $allowAddDescription;
    }

    /**
     * @inheritdoc
     */
    public function getByCustomerEmail(string $customerEmail): AllowAddDescriptionInterface
    {
        /** @var AllowAddDescriptionModel $allowAddDescription */
        $allowAddDescription = $this->modelFactory->create();
        $this->resource->load($allowAddDescription, $customerEmail, AllowAddDescriptionModel::DATA_KEY_CUSTOMER_EMAIl);
        if (!$allowAddDescription->getId()) {
            throw new NoSuchEntityException(
                __('The Allow Add Description Model with the "%1" email does not exist.', $customerEmail)
            );
        }

        return $allowAddDescription;
    }
}
