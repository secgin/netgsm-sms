<?php

namespace YG\Netgsm\Soap\Response;

class SendSmsResponse
{
    public string $messageId;

    public string $code;

    public string $errorMessage;

    public function __construct()
    {
        $this->messageId = '';
        $this->code = '';
        $this->errorMessage = '';
    }

    public function isSuccess(): bool
    {
        return empty($this->code);
    }
}