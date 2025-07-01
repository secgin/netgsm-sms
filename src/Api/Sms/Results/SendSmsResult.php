<?php

namespace YG\Netgsm\Api\Sms\Results;

use YG\ApiLibraryBase\Abstracts\Http\HttpResult;
use YG\ApiLibraryBase\Abstracts\Result\AbstractResult;
use YG\ApiLibraryBase\Abstracts\Result\Result;

final class SendSmsResult extends AbstractResult
{
    private bool $success;
    public static function create(HttpResult $httpResult): Result
    {
        $data = json_decode($httpResult->getContent()) ?? null;

        $result = new self();
        $result->success = $httpResult->isSuccess();
        $result->data = $data;
        return $result;
    }
    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getErrorCode(): string
    {
        return $this->success ? '' : $this->data->code ?? '';
    }

    public function getErrorMessage(): string
    {
        return $this->success ? '' : $this->data->description ?? '';
    }

    public function getData()
    {
       return $this->data;
    }
}