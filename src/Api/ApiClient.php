<?php

namespace YG\Netgsm\Api;

use YG\ApiLibraryBase\Abstracts\AbstractApiClient;
use YG\Netgsm\Api\Sms\Handlers\SendSmsHandler;

final class ApiClient extends AbstractApiClient implements NetgsmApiClient
{

    protected function getRequestHandlerClasses(): array
    {
        return [
            'sendSms' => SendSmsHandler::class
        ];
    }
}