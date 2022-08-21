<?php

namespace YG\Netgsm\Soap;

use YG\Netgsm\Soap\Handler\SendMultiSmsRequestHandler;
use YG\Netgsm\Soap\Handler\SendSmsRequestHandler;
use YG\Netgsm\Soap\Request\SendMultiSmsRequest;
use YG\Netgsm\Soap\Request\SendSmsRequest;
use YG\Netgsm\Soap\Response\SendSmsResponse;

class Client implements ClientInterface
{
    const WSDL_URL = 'http://soap.netgsm.com.tr:8080/Sms_webservis/SMS?wsdl';

    private string
        $username = '',
        $password = '',
        $defaultMessageHeader;

    private array $defaultParams = [];

    /**
     * @param string   $username
     * @param string   $password
     * @param string   $defaultMessageHeader
     * @param string[] $defaultParams
     */
    public function __construct(string $username, string $password, string $defaultMessageHeader,
                                array $defaultParams = [])
    {
        $this->username = $username;
        $this->password = $password;
        $this->defaultMessageHeader = $defaultMessageHeader;
        $this->defaultParams = array_merge(
            [
                'header' => $this->defaultMessageHeader,
                'filter' => '11',
                'encoding' => 'TR'
            ],
            $defaultParams);
    }

    public function send(string $message, array $phones, array $params = []): SendSmsResponse
    {
        $parameters = array_merge(
            [
                'username' => $this->username,
                'password' => $this->password
            ],
            $this->defaultParams,
            $params);

        return
            (new SendSmsRequestHandler(self::WSDL_URL))
                ->handle(
                    (new SendSmsRequest($message, $phones))
                        ->setParams($parameters));
    }

    public function sendMultiple(array $phonesAndMessages, array $params = []): SendSmsResponse
    {
        $parameters = array_merge(
            [
                'username' => $this->username,
                'password' => $this->password
            ],
            $this->defaultParams,
            $params);

        return
            (new SendMultiSmsRequestHandler(self::WSDL_URL))
                ->handle(
                    (new SendMultiSmsRequest($phonesAndMessages))
                        ->setParams($parameters));
    }
}