<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Service\Facade\Calculator\Dneonline\Request;

interface RequestInterface
{
    public function getMultiplyRequestBodyByArguments(array $arguments): string;

    public function getContentType(): string;

    public function getBaseUrl(): string;
}
