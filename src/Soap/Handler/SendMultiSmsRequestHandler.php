<?php

namespace YG\Netgsm\Soap\Handler;

use YG\Netgsm\Soap\Curl;
use YG\Netgsm\Soap\ErrorCode;
use YG\Netgsm\Soap\Request\RequestAbstract;
use YG\Netgsm\Soap\Response\SendSmsResponse;
use YG\Netgsm\Soap\Xml;

class SendMultiSmsRequestHandler extends RequestHandlerAbstract
{
    public function handle(RequestAbstract $request): SendSmsResponse
    {
        $response = Curl::execute([
            CURLOPT_URL => $this->wsdl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => Xml::create('smsGonderNNV2', $request->toArray()),
            CURLOPT_HTTPHEADER => [
                'Content-Type: text/xml'
            ]
        ]);

        return $this->parseResponse($response);
    }

    private function parseResponse(string $response): SendSmsResponse
    {
        $sendSmsResponse = new SendSmsResponse();

        $result = Xml::parse($response, '//return');
        if ($result == null)
        {
            $sendSmsResponse->errorMessage = 'XML parse error';
        }
        else
        {
            $code = (string)$result[0];
            if (array_key_exists($code, ErrorCode::CODES))
            {
                $sendSmsResponse->code = $code;
                $sendSmsResponse->errorMessage = ErrorCode::CODES[$code];
            }
            else
                $sendSmsResponse->messageId = $code;
        }

        return $sendSmsResponse;
    }
}