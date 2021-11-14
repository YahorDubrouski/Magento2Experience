<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Mediator;

class User
{
    public function notifyAboutService(string $serviceName): void
    {
        echo "<div>Service: $serviceName was executed</div>";
    }
}
