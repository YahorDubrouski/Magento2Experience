<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Model\DevelopmentPrinciples;

interface LastFirst
{
    public function lastFirst(string $name): void;
}
