<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\ChainOfResponsibility\EmergencyService;

class Police implements EmergencyServiceInterface
{
    private const KEY_WORD_FOR_CALL_SERVICE = 'Murder';

    public function callByUserRequest(string $request): void
    {
        if (str_contains($request, self::KEY_WORD_FOR_CALL_SERVICE)) {
            echo 'Police will be soon';
        }
    }
}
