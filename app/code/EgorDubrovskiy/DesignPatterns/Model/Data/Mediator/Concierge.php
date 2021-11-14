<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Mediator;

use Magento\Framework\Exception\LocalizedException;

class Concierge
{
    public const SERVICE_TAXI = 'Call Taxi';
    public const SERVICE_CALL_MASTER = 'Call a master at home';
    public const SERVICE_FLOWER_DELIVERY = 'Flower delivery';

    public const SERVICE_NAMES = [
        self::SERVICE_TAXI,
        self::SERVICE_CALL_MASTER,
        self::SERVICE_FLOWER_DELIVERY,
    ];

    private NotificationMediator $notificationMediator;

    public function __construct(
        NotificationMediator $notificationMediator
    ) {
        $this->notificationMediator = $notificationMediator;
    }

    /**
     * @param string $serviceName
     * @throws LocalizedException
     */
    public function executeServiceByName(string $serviceName): void
    {
        if (!in_array($serviceName, self::SERVICE_NAMES)) {
            throw new LocalizedException(__("Service: $serviceName does not exist"));
        }

        echo "<div>Service: $serviceName is executing</div>";

        $this->notificationMediator->notifyAboutService($serviceName);
    }
}
