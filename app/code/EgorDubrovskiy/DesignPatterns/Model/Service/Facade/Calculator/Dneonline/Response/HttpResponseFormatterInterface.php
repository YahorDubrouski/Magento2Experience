<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Service\Facade\Calculator\Dneonline\Response;

interface HttpResponseFormatterInterface
{
    public function formatMultiplyResponse(string $response): float;
}
