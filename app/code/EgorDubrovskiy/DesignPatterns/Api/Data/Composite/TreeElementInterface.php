<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Api\Data\Composite;

/**
 * Interface TreeElementInterface
 * @package EgorDubrovskiy\DesignPatterns\Api\Data\Composite
 * @api
 */
interface TreeElementInterface
{
    /**
     * @return TreeElementInterface
     */
    public function incrementNumberOfInsects(): TreeElementInterface;

    /**
     * @return TreeElementInterface
     */
    public function decrementNumberOfInsects(): TreeElementInterface;
}
