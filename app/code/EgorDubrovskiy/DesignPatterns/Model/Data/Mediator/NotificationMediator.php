<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Mediator;

class NotificationMediator
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function notifyAboutService(string $serviceName): void
    {
        $this->user->notifyAboutService($serviceName);
    }
}
