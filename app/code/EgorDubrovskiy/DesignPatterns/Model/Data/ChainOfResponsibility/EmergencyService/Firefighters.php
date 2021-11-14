<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\ChainOfResponsibility\EmergencyService;

class Firefighters implements EmergencyServiceInterface
{
    private const KEY_WORD_FOR_CALL_SERVICE = 'Fire';

    public function callByUserRequest(string $request): void
    {
        if (str_contains($request, self::KEY_WORD_FOR_CALL_SERVICE)) {
            echo 'Firefighters will be soon';
        }
    }
}
