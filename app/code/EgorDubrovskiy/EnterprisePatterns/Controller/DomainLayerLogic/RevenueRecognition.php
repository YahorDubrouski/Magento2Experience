<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Controller\DomainLayerLogic;

use EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\RevenueRecognition\ProductRevenueStrategyCalculator;
use Exception;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Raw as ResultRaw;
use Magento\Framework\Controller\Result\RawFactory as ResultRawFactory;
use Magento\Framework\Intl\DateTimeFactory;

class RevenueRecognition implements HttpGetActionInterface
{
    public const REQUEST_PARAM_NAME_STRATEGY = 'strategy';
    public const REQUEST_PARAM_NAME_PRODUCT_TYPE = 'product_type';
    public const REQUEST_PARAM_NAME_DATE_OF_PRODUCT_PURCHASE = 'date_of_product_purchase';

    private RequestInterface $request;

    private ResultRawFactory $resultRawFactory;

    private ProductRevenueStrategyCalculator $productRevenueStrategyCalculator;

    private DateTimeFactory $dateTimeFactory;

    public function __construct(
        RequestInterface $request,
        ResultRawFactory $resultRawFactory,
        ProductRevenueStrategyCalculator $productRevenueStrategyCalculator,
        DateTimeFactory $dateTimeFactory
    ) {
        $this->request = $request;
        $this->resultRawFactory = $resultRawFactory;
        $this->productRevenueStrategyCalculator = $productRevenueStrategyCalculator;
        $this->dateTimeFactory = $dateTimeFactory;
    }

    /**
     * @return ResultRaw
     * @throws Exception
     */
    public function execute()
    {
        $strategy = (string) $this->request->getParam(self::REQUEST_PARAM_NAME_STRATEGY);
        $productType = (string) $this->request->getParam(self::REQUEST_PARAM_NAME_PRODUCT_TYPE);
        $dateOfProductPurchase = $this->dateTimeFactory->create(
            $this->request->getParam(self::REQUEST_PARAM_NAME_DATE_OF_PRODUCT_PURCHASE)
        );
        $revenue = $this->productRevenueStrategyCalculator->calculate($strategy, $productType, $dateOfProductPurchase);

        $resultContent = '<div><b>Revenue Recognition</b></div>';
        $resultContent .= '<pre>Revenue: ' . $revenue . '</pre>';
        return $this->resultRawFactory->create()->setContents($resultContent);
    }
}
