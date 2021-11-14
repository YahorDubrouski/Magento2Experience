<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Observer;

interface StormNotifierInterface
{
    public function addObserver(StormObserverInterface $observer): StormNotifierInterface;

    public function notifyAboutStorm(Storm $storm): StormNotifierInterface;
}
