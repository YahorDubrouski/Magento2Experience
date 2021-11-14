<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Service\Facade\Calculator\Dneonline;

use EgorDubrovskiy\DesignPatterns\Model\Service\Facade\Calculator\CalculatorInterface;
use EgorDubrovskiy\DesignPatterns\Model\Service\Facade\Calculator\Dneonline\Request\RequestInterface
    as HttpRequestInterface;
use EgorDubrovskiy\DesignPatterns\Model\Service\Facade\Calculator\Dneonline\Response\HttpResponseFormatterInterface;
use Magento\Framework\HTTP\ClientInterface as HTTPClientInterface;

class DneonlineCalculator implements CalculatorInterface
{
    private HttpRequestInterface $httpRequest;

    private HTTPClientInterface $httpClient;

    private HttpResponseFormatterInterface $httpResponseFormatter;

    public function __construct(
        HttpRequestInterface $httpRequest,
        HTTPClientInterface $httpClient,
        HttpResponseFormatterInterface $httpResponseFormatter
    ) {
        $this->httpRequest = $httpRequest;
        $this->httpClient = $httpClient;
        $this->httpResponseFormatter = $httpResponseFormatter;
    }

    public function multiplyArguments(array $arguments): float
    {
        $httpRequestBody = $this->httpRequest->getMultiplyRequestBodyByArguments($arguments);
        $this->httpClient->addHeader('Content-Type', $this->httpRequest->getContentType() . '; charset=utf-8');
        $this->httpClient->addHeader('Content-Length', strlen($httpRequestBody));
        $this->httpClient->post($this->httpRequest->getBaseUrl(), $httpRequestBody);
        $httpResponseBody = $this->httpClient->getBody();

        return $this->httpResponseFormatter->formatMultiplyResponse($httpResponseBody);
    }
}
