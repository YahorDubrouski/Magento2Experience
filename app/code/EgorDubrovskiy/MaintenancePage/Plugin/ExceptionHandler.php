<?php

namespace EgorDubrovskiy\MaintenancePage\Plugin;

use EgorDubrovskiy\MaintenancePage\Api\MaintenancePageConfigInterface;
use EgorDubrovskiy\MaintenancePage\Api\MaintenancePageResponseInterface;
use Magento\Framework\App\Bootstrap;
use Closure;
use Exception;
use Magento\Framework\App\ExceptionHandler as MagentoExceptionHandler;
use Magento\Framework\App\Request\Http as HttpRequest;
use Magento\Framework\App\Response\Http as HttpResponse;

class ExceptionHandler
{
    protected MaintenancePageResponseInterface $maintenancePageResponse;

    protected MaintenancePageConfigInterface $maintenancePageConfig;

    public function __construct(
        MaintenancePageResponseInterface $maintenancePageResponse,
        MaintenancePageConfigInterface $maintenancePageConfig
    ) {
        $this->maintenancePageResponse = $maintenancePageResponse;
        $this->maintenancePageConfig = $maintenancePageConfig;
    }

    public function aroundHandle(
        MagentoExceptionHandler $magentoExceptionHandler,
        Closure $proceed,
        Bootstrap $bootstrap,
        Exception $exception,
        HttpResponse $response,
        HttpRequest $request
    ): bool
    {
        if ($this->shouldShowMaintenancePage($bootstrap)) {
            $this->maintenancePageResponse->sendResponse();
            return true;
        }

        return $proceed($bootstrap, $exception, $response, $request);
    }

    protected function shouldShowMaintenancePage(Bootstrap $bootstrap): bool
    {
        return $bootstrap->isDeveloperMode() === false
            && $bootstrap->getErrorCode() === Bootstrap::ERR_MAINTENANCE
            && $this->maintenancePageConfig->isEnabled()
            && $this->maintenancePageConfig->hasPageIdentifier();
    }
}
