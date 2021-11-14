<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Service\Facade\Calculator\Dneonline\Request;

class XMLRequest implements RequestInterface
{
    private const CONTENT_TYPE = 'text/xml';
    private const BASE_URL = 'http://www.dneonline.com/calculator.asmx';

    public function getMultiplyRequestBodyByArguments(array $arguments): string
    {
        $argumentsInXML = '';
        foreach ($arguments as $index => $argument) {
            $letter = range('A', 'Z')[$index];
            $argumentsInXML .= "<int$letter>$argument</int$letter>";
        }

        return <<<XML
<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:xsd="http://www.w3.org/2001/XMLSchema"
    xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <Multiply xmlns="http://tempuri.org/">$argumentsInXML</Multiply>
  </soap:Body>
</soap:Envelope>
XML;
    }

    public function getContentType(): string
    {
        return self::CONTENT_TYPE;
    }

    public function getBaseUrl(): string
    {
        return self::BASE_URL;
    }
}
