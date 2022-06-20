<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Controller\DomainLayerLogic;

use EgorDubrovskiy\EnterprisePatterns\Model\DomainLayerLogic\RevenueRecognition\RecognizedRevenueCalculator;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\RawFactory as ResultRawFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Intl\DateTimeFactory;

/**
 * Code in Model/DomainLayerLogic/RevenueRecognition duplicates to show differences between different approaches
 * Data was set using di.xml (without database) to make the realization faster
 */
class RevenueRecognition implements HttpGetActionInterface
{
    public const REQUEST_PARAM_NAME_STRATEGY = 'strategy';
    public const REQUEST_PARAM_NAME_CONTRACT_ID = 'contract_id';

    private RequestInterface $request;

    private ResultRawFactory $resultRawFactory;

    private RecognizedRevenueCalculator $productRevenueStrategyCalculator;

    public function __construct(
        RequestInterface $request,
        ResultRawFactory $resultRawFactory,
        RecognizedRevenueCalculator $productRevenueStrategyCalculator,
        DateTimeFactory $dateTimeFactory
    ) {
        $this->request = $request;
        $this->resultRawFactory = $resultRawFactory;
        $this->productRevenueStrategyCalculator = $productRevenueStrategyCalculator;
    }

    /**
     * @inheritdoc
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $strategy = (string) $this->request->getParam(self::REQUEST_PARAM_NAME_STRATEGY);
        $contractId = (int) $this->request->getParam(self::REQUEST_PARAM_NAME_CONTRACT_ID);
        $revenue = $this->productRevenueStrategyCalculator->calculate($strategy, $contractId);

        $resultContent = '<div><b>Revenue Recognition</b></div>';
        $resultContent .= '<pre>Revenue: ' . $revenue . '</pre>';
        return $this->resultRawFactory->create()->setContents($resultContent);
    }
}
