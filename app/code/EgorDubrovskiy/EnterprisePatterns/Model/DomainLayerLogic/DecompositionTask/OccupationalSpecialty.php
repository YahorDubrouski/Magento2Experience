<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\DecompositionTask;

use Magento\Framework\DataObject;

class OccupationalSpecialty extends DataObject
{
    public const DATA_KEY_ID = 'id';
    public const DATA_KEY_NAME = 'name';

    public function getId(): ?int
    {
        return $this->getDataByKey(self::DATA_KEY_ID);
    }

    public function setId(?int $id): OccupationalSpecialty
    {
        return $this->setData(self::DATA_KEY_ID, $id);
    }

    public function getName(): string
    {
        return $this->getDataByKey(self::DATA_KEY_NAME);
    }

    public function setName(string $name): OccupationalSpecialty
    {
        return $this->setData(self::DATA_KEY_NAME, $name);
    }
}
