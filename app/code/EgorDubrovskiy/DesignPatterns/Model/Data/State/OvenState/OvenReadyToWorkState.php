<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\State\OvenState;

use EgorDubrovskiy\DesignPatterns\Model\Data\State\OvenStateInterface;

class OvenReadyToWorkState implements OvenStateInterface
{
    /**
     * @inheritdoc
     */
    public function bake(): OvenStateInterface
    {
        echo 'Oven was started to bake';

        return $this;
    }
}
