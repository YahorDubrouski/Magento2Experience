<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Observer;

class StormNotifier implements StormNotifierInterface
{
    /**
     * @var StormObserverInterface[]
     */
    private array $observers = [];

    public function addObserver(StormObserverInterface $observer): StormNotifierInterface
    {
        $this->observers[] = $observer;

        return $this;
    }

    public function notifyAboutStorm(Storm $storm): StormNotifierInterface
    {
        foreach ($this->observers as $observer) {
            $observer->execute($storm);
        }

        return $this;
    }
}
