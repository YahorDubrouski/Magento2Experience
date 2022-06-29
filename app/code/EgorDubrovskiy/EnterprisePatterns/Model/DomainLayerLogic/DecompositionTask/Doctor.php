<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\DecompositionTask;

use Magento\Framework\DataObject;

class Doctor extends DataObject
{
    public const DATA_KEY_ID = 'id';
    public const DATA_KEY_APPOINTMENTS = 'appointments';
    public const DATA_KEY_SPECIALITIES = 'specialities';

    public function getId(): ?int
    {
        return $this->getDataByKey(self::DATA_KEY_ID);
    }

    public function setId(?int $id): Doctor
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
     * @return Doctor
     */
    public function setAppointments(array $appointments): Doctor
    {
        return $this->setData(self::DATA_KEY_APPOINTMENTS, $appointments);
    }

    /**
     * @return OccupationalSpecialty[]
     */
    public function getSpecialities(): array
    {
        return (array) $this->getDataByKey(self::DATA_KEY_SPECIALITIES);
    }

    /**
     * @param OccupationalSpecialty[] $specialities
     * @return Doctor
     */
    public function setSpecialities(array $specialities): Doctor
    {
        return $this->setData(self::DATA_KEY_SPECIALITIES, $specialities);
    }
}
