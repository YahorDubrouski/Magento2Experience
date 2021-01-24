<?php

namespace EgorDubrovskiy\MaintenancePage\Model;

use EgorDubrovskiy\MaintenancePage\Api\MaintenancePageConfigInterface;
use EgorDubrovskiy\MaintenancePage\Api\MaintenancePageResponseInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Cms\Api\GetPageByIdentifierInterface as CmsPageGetter;
use Magento\Framework\App\Response\Http as HttpResponse;

class MaintenancePageResponse implements MaintenancePageResponseInterface
{
    const HTTP_STATUS_CODE_SERVICE_UNAVAILABLE = HttpResponse::STATUS_CODE_503;

    protected StoreManagerInterface $storeManager;

    protected CmsPageGetter $cmsPageGetter;

    protected HttpResponse $httpResponse;

    protected MaintenancePageConfigInterface $maintenancePageConfig;

    public function __construct(
        StoreManagerInterface $storeManager,
        CmsPageGetter $cmsPageGetter,
        HttpResponse $httpResponse,
        MaintenancePageConfigInterface $maintenancePageConfig
    ) {
        $this->storeManager = $storeManager;
        $this->cmsPageGetter = $cmsPageGetter;
        $this->httpResponse = $httpResponse;
        $this->maintenancePageConfig = $maintenancePageConfig;
    }

    public function sendResponse(): void
    {
        $this->httpResponse->setHttpResponseCode(self::HTTP_STATUS_CODE_SERVICE_UNAVAILABLE)
            ->setBody($this->getMaintenancePageContent())
            ->sendResponse();
    }

    protected function getMaintenancePageContent(): string
    {
        $pageIdentifier = $this->maintenancePageConfig->getPageIdentifier();
        $currentStoreId = (int) $this->storeManager->getStore()->getId();
        $cmsPage = $this->cmsPageGetter->execute($pageIdentifier, $currentStoreId);

        return $cmsPage->getContent();
    }
}
