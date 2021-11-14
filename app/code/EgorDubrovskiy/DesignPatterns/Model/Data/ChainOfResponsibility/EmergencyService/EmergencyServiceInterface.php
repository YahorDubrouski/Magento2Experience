<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\ChainOfResponsibility\EmergencyService;

interface EmergencyServiceInterface
{
    public function callByUserRequest(string $request): void;
}
