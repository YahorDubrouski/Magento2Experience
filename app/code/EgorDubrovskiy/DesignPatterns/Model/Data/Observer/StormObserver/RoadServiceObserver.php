<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Observer\StormObserver;

use EgorDubrovskiy\DesignPatterns\Model\Data\Observer\Storm;
use EgorDubrovskiy\DesignPatterns\Model\Data\Observer\StormObserverInterface;

class RoadServiceObserver implements StormObserverInterface
{
    public function execute(Storm $storm): void
    {
        if ($storm->getThreadLevel() === Storm::THREAD_LEVEL_LOW
            || $storm->getThreadLevel() === Storm::THREAD_LEVEL_HIGH
        ) {
            echo '<div>A Road Service took actions</div>';
        }
    }
}
