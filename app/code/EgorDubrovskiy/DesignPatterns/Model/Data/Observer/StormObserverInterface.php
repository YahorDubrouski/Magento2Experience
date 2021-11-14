<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Observer;

interface StormObserverInterface
{
    public function execute(Storm $storm): void;
}
