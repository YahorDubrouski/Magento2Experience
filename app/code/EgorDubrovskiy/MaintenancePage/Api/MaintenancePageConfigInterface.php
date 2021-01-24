<?php

namespace EgorDubrovskiy\MaintenancePage\Api;

interface MaintenancePageConfigInterface
{
    public function isEnabled(): bool;

    public function getPageIdentifier(): string;

    public function hasPageIdentifier(): bool;
}
