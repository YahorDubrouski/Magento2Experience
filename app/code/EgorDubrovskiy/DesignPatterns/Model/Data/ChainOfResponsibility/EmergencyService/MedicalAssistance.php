<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\ChainOfResponsibility\EmergencyService;

class MedicalAssistance implements EmergencyServiceInterface
{
    private const KEY_WORD_FOR_CALL_SERVICE = 'Medical Assistance';

    public function callByUserRequest(string $request): void
    {
        if (str_contains($request, self::KEY_WORD_FOR_CALL_SERVICE)) {
            echo 'Medical Assistance will be soon';
        }
    }
}
