<?php

namespace YG\Netgsm\Soap;

use YG\Netgsm\Soap\Handler\SendMultiSmsRequestHandler;
use YG\Netgsm\Soap\Handler\SendSmsRequestHandler;
use YG\Netgsm\Soap\Request\SendMultiSmsRequest;
use YG\Netgsm\Soap\Request\SendSmsRequest;
use YG\Netgsm\Soap\Response\SendSmsResponse;

class Client implements ClientInterface
{
    private string
        $wsdl = '',
        $username = '',
        $password = '',
        $defaultMessageHeader;

    private array $defaultParams = [];

    /**
     * @param string   $wsdl
     * @param string   $username
     * @param string   $password
     * @param string   $defaultMessageHeader
     * @param string[] $defaultParams
     */
    public function __construct(string $wsdl, string $username, string $password, string $defaultMessageHeader,
                                array  $defaultParams = [])
    {
        $this->wsdl = $wsdl;
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
            (new SendSmsRequestHandler($this->wsdl))
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
            (new SendMultiSmsRequestHandler($this->wsdl))
                ->handle(
                    (new SendMultiSmsRequest($phonesAndMessages))
                        ->setParams($parameters));
    }
}