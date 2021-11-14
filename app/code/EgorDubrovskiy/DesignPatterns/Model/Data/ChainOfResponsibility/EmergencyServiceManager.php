<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\ChainOfResponsibility;

use EgorDubrovskiy\DesignPatterns\Model\Data\ChainOfResponsibility\EmergencyService\EmergencyServiceInterface;

class EmergencyServiceManager
{
    /** @var EmergencyServiceInterface[] */
    private array $services;

    public function __construct(array $services)
    {
        $this->services = $services;
    }

    public function callByUserRequest(string $request): void
    {
        foreach ($this->services as $service) {
            $service->callByUserRequest($request);
        }
    }
}
