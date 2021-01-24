<?php

namespace EgorDubrovskiy\Core\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    protected ScopeConfigInterface $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }
}
