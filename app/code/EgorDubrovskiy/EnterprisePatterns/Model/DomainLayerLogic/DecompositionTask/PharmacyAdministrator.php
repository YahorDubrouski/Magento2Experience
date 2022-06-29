<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\DecompositionTask;

class PharmacyAdministrator
{
    private DoctorAppointmentFactory $doctorAppointmentFactory;

    public function __construct(DoctorAppointmentFactory $doctorAppointmentFactory)
    {
        $this->doctorAppointmentFactory = $doctorAppointmentFactory;
    }

    public function createAppointment(
        string $dateTime,
        int $doctorId,
        int $patientId
    ): DoctorAppointment
    {
        $appointment = $this->doctorAppointmentFactory->create();
        $appointment->setDateTime($dateTime)
            ->setDoctorId($doctorId)
            ->setPatientId($patientId);

        return $appointment;
    }
}
