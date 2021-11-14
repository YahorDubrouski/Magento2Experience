<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\State\OvenState;

use EgorDubrovskiy\DesignPatterns\Model\Data\State\OvenStateInterface;
use Magento\Framework\Exception\LocalizedException;

class OvenHotState implements OvenStateInterface
{
    /**
     * @inheritdoc
     */
    public function bake(): OvenStateInterface
    {
        throw new LocalizedException(__('The Oven is too hot'));
    }
}
