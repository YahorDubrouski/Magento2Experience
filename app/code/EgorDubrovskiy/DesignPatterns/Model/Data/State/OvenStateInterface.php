<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\State;

use Magento\Framework\Exception\LocalizedException;

interface OvenStateInterface
{
    /**
     * @return OvenStateInterface
     * @throws LocalizedException
     */
    public function bake(): OvenStateInterface;
}
