<?php

namespace YG\Netgsm\Api\Sms\Handlers;

use YG\ApiLibraryBase\Abstracts\Request\AbstractRequestHandler;
use YG\ApiLibraryBase\Abstracts\Request\Request;
use YG\ApiLibraryBase\Abstracts\Result\Result as ResultInterface;
use YG\ApiLibraryBase\Http\HttpRequest;
use YG\Netgsm\Api\Sms\Results\SendSmsResult;

class SendSmsHandler extends AbstractRequestHandler
{
    public function handle(Request $request): ResultInterface
    {
        $data = $request->getParams();
        if (empty($data['msgheader']))
            $data['msgheader'] = $this->config->get('defaultMessageHeader');

        $httpRequest = HttpRequest::post($this->config->get('serviceUrl') . '/sms/rest/v2/send')
            ->setBasicAuthentication($this->config->get('username'), $this->config->get('password'))
            ->setData($data);

        $httpResult = $this->httpClient->send($httpRequest);
        return SendSmsResult::create($httpResult);
    }
}