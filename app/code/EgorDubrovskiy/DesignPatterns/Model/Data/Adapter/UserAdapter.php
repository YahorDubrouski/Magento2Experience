<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Adapter;

use EgorDubrovskiy\DesignPatterns\Api\Data\Adapter\UserAdapterInterface;

class UserAdapter implements UserAdapterInterface
{
    private Пользователь $user;

    public function __construct(Пользователь $user)
    {
        $this->user = $user;
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return $this->user->получитьИмя();
    }
}
