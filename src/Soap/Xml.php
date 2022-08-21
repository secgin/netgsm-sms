<?php

namespace YG\Netgsm\Soap;

final class Xml
{
    public static function create(string $methodName, array $parameters): string
    {
        $parameterStr = join(
            PHP_EOL,
            array_map(
                function($parameter) {
                    return sprintf('<%s>%s</%s>', $parameter['name'], $parameter['value'], $parameter['name']);
                }, array_filter($parameters, function($parameter) {
                return !is_null($parameter['value']);
            })));

        return <<<EOD
<?xml version="1.0"?>
    <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
                 xmlns:xsd="http://www.w3.org/2001/XMLSchema"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
        <SOAP-ENV:Body>
            <ns3:$methodName xmlns:ns3="http://sms/">
                $parameterStr
            </ns3:$methodName>
        </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>'
EOD;
    }

    public static function parse(string $xml, string $xpath): ?array
    {
        $xml = simplexml_load_string($xml);
        if ($xml === false)
            return null;

        return $xml->xpath($xpath);
    }
}