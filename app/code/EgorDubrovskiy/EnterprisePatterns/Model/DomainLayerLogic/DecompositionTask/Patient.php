<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\DecompositionTask;

use Magento\Framework\DataObject;

class Patient extends DataObject
{
    public const DATA_KEY_ID = 'id';
    public const DATA_KEY_APPOINTMENTS = 'appointments';

    public function getId(): ?int
    {
        return $this->getDataByKey(self::DATA_KEY_ID);
    }

    public function setId(?int $id): Patient
    {
        return $this->setData(self::DATA_KEY_ID, $id);
    }

    /**
     * @return DoctorAppointment[]
     */
    public function getAppointments(): array
    {
        return (array) $this->getDataByKey(self::DATA_KEY_APPOINTMENTS);
    }

    /**
     * @param DoctorAppointment[] $appointments
     * @return Patient
     */
    public function setAppointments(array $appointments): Patient
    {
        return $this->setData(self::DATA_KEY_APPOINTMENTS, $appointments);
    }
}
