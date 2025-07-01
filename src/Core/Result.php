<?php

namespace YG\Netgsm\Core;

use YG\ApiLibraryBase\Abstracts\Result\AbstractResult;

final class Result extends AbstractResult
{
    private bool $success;
    private string $errorCode;
    private string $errorMessage;
    public static function success($data): Result
    {
        $result = new self();
        $result->success = true;
        $result->data = $data;
        return $result;
    }

    public static function fail(string $errorCode, string $errorMessage, $data = null): Result
    {
        $result = new self();
        $result->success = false;
        $result->errorCode = $errorCode;
        $result->errorMessage = $errorMessage;
        $result->data = $data;
        return $result;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function getData()
    {
        return $this->data;
    }

    public function __get($name)
    {
        if ($name == 'data')
        {
            if (isset($this->data->data))
            {
                if (is_array($this->data->data) or is_object($this->data->data))
                    return $this->data->data;

                return $this->data->data;
            }

            return $this->data;
        }

        $propertyName = $name;
        if (isset($this->data->$propertyName))
            return $this->data->$propertyName;

        return parent::__get($name);
    }
}