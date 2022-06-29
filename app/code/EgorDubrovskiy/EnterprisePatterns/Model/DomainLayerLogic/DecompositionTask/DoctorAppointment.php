<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\DecompositionTask;

use Magento\Framework\DataObject;

class DoctorAppointment extends DataObject
{
    public const DATA_KEY_ID = 'id';
    public const DATA_KEY_DATE_TIME = 'date_time';
    public const DATA_KEY_DOCTOR_ID = 'doctor_id';
    public const DATA_KEY_PATIENT_ID = 'patient_id';

    public function getId(): ?int
    {
        return $this->getDataByKey(self::DATA_KEY_ID);
    }

    public function setId(?int $id): DoctorAppointment
    {
        return $this->setData(self::DATA_KEY_ID, $id);
    }

    public function getDateTime(): string
    {
        return $this->getDataByKey(self::DATA_KEY_DATE_TIME);
    }

    public function setDateTime(string $dateTime): DoctorAppointment
    {
        return $this->setData(self::DATA_KEY_DATE_TIME, $dateTime);
    }

    public function getDoctorId(): int
    {
        return $this->getDataByKey(self::DATA_KEY_DOCTOR_ID);
    }

    public function setDoctorId(int $doctorId): DoctorAppointment
    {
        return $this->setData(self::DATA_KEY_DOCTOR_ID, $doctorId);
    }

    public function getPatientId(): int
    {
        return $this->getDataByKey(self::DATA_KEY_PATIENT_ID);
    }

    public function setPatientId(int $patientId): DoctorAppointment
    {
        return $this->setData(self::DATA_KEY_PATIENT_ID, $patientId);
    }
}
