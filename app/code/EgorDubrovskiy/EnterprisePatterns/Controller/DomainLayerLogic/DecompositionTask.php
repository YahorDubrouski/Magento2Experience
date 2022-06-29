<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Controller\DomainLayerLogic;

use EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\DecompositionTask\PharmacyAdministrator;
use EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\DecompositionTask\Doctor;
use EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\DecompositionTask\DoctorAppointment;
use EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\DecompositionTask\OccupationalSpecialty;
use EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\DecompositionTask\Patient;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\RawFactory as ResultRawFactory;

class DecompositionTask implements HttpGetActionInterface
{
    private ResultRawFactory $resultRawFactory;

    private PharmacyAdministrator $pharmacyAdministrator;

    private array $appointments = [];

    public function __construct(
        ResultRawFactory $resultRawFactory,
        PharmacyAdministrator $pharmacyAdministrator
    ) {
        $this->resultRawFactory = $resultRawFactory;
        $this->pharmacyAdministrator = $pharmacyAdministrator;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        $resultContent = '<div><b>Decomposition Task</b></div>';
        $database = $this->createDatabase();
        $resultContent .= '<pre>Database: ' . var_export($database, true) . '</pre>';

        return $this->resultRawFactory->create()->setContents($resultContent);
    }

    /**
     * Generate data instead of real database to simplify the example
     */
    private function createDatabase(): array
    {
        return [
            'specialities' => $this->generateSpecialities(),
            'appointments' => $this->generateAppointments(),
            'patients' => $this->generatePatients(),
            'doctors' => $this->generateDoctors(),
        ];
    }

    private function generateSpecialities(): array
    {
        return [
            (new OccupationalSpecialty())->setId(1)->setName('Pediatrician'),
            (new OccupationalSpecialty())->setId(2)->setName('Dentist'),
        ];
    }

    private function generateAppointments(): array
    {
        if (!$this->appointments) {
            $this->appointments = [
                $this->pharmacyAdministrator->createAppointment('01-11-2020', 2, 1),
                $this->pharmacyAdministrator->createAppointment('01-12-2020', 1, 1),
                $this->pharmacyAdministrator->createAppointment('02-12-2020', 1, 2),
                $this->pharmacyAdministrator->createAppointment('03-12-2020', 2, 2),
            ];
        }

        return $this->appointments;
    }

    private function generatePatients(): array
    {
        $findAppointment = function (int $patientId) {
            return array_filter(
                $this->appointments,
                function (DoctorAppointment $appointment) use ($patientId) {
                    return $appointment->getPatientId() === $patientId;
                }
            );
        };

        return [
            (new Patient())->setId(1)->setAppointments($findAppointment(1)),
            (new Patient())->setId(2)->setAppointments($findAppointment(2)),
        ];
    }

    private function generateDoctors(): array
    {
        $findAppointment = function (int $doctorId) {
            return array_filter(
                $this->appointments,
                function (DoctorAppointment $appointment) use ($doctorId) {
                    return $appointment->getDoctorId() === $doctorId;
                }
            );
        };

        return [
            (new Doctor())->setId(1)->setAppointments($findAppointment(1)),
            (new Doctor())->setId(2)->setAppointments($findAppointment(2)),
        ];
    }
}
