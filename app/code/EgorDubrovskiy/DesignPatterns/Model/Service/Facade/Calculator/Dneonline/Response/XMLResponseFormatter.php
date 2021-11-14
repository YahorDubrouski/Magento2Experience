<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Service\Facade\Calculator\Dneonline\Response;
use Magento\Framework\DomDocument\DomDocumentFactory;

class XMLResponseFormatter implements HttpResponseFormatterInterface
{
    private DomDocumentFactory $domDocumentFactory;

    public function __construct(
        DomDocumentFactory $domDocumentFactory
    ) {
        $this->domDocumentFactory = $domDocumentFactory;
    }

    public function formatMultiplyResponse(string $response): float
    {
        $dom = $this->domDocumentFactory->create();
        $dom->loadXML($response);

        return (float) $dom->getElementsByTagName('MultiplyResult')[0]->nodeValue;
    }
}
