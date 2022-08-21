<?php

namespace YG\Netgsm\Soap\Handler;

use YG\Netgsm\Soap\Request\RequestAbstract;

abstract class RequestHandlerAbstract
{
    protected string $wsdl = '';

    public function __construct(string $wsdl)
    {
        $this->wsdl = $wsdl;
    }

    abstract public function handle(RequestAbstract $request);
}