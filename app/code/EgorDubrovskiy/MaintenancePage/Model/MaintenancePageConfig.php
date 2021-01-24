<?php

namespace EgorDubrovskiy\MaintenancePage\Model;

use EgorDubrovskiy\Core\Model\Config;
use EgorDubrovskiy\MaintenancePage\Api\MaintenancePageConfigInterface;
use Magento\Store\Model\ScopeInterface;

class MaintenancePageConfig extends Config implements MaintenancePageConfigInterface
{
    const CONFIG_PATH_IS_ENABLED = 'egor_dubrovskiy_maintenance_page/general/is_enabled';
    const CONFIG_PATH_PAGE_IDENTIFIER = 'egor_dubrovskiy_maintenance_page/general/page_identifier';

    public function isEnabled(): bool
    {
        return (bool) $this->scopeConfig->getValue(self::CONFIG_PATH_IS_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    public function getPageIdentifier(): string
    {
        return (string) $this->scopeConfig->getValue(self::CONFIG_PATH_PAGE_IDENTIFIER, ScopeInterface::SCOPE_STORE);
    }

    public function hasPageIdentifier(): bool
    {
        return !empty($this->getPageIdentifier());
    }
}
