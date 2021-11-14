<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Api\Data\Adapter;

/**
 * Interface UserAdapterInterface
 * @package EgorDubrovskiy\DesignPatterns\Api\Data\Adapter
 * @api
 */
interface UserAdapterInterface
{
    /**
     * @return string
     */
    public function getName(): string;
}
