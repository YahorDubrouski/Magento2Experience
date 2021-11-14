<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Observer;

class Storm
{
    public const THREAD_LEVEL_LOW = 'Low';
    public const THREAD_LEVEL_HIGH = 'High';

    private string $threadLevel = self::THREAD_LEVEL_LOW;

    public function setThreadLevel(string $level): self
    {
        $this->threadLevel = $level;

        return $this;
    }

    public function getThreadLevel(): string
    {
        return $this->threadLevel;
    }
}
