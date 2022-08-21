<?php

namespace YG\Netgsm\Soap\Request;

final class SendMultiSmsRequest extends RequestAbstract
{
    public string $username;

    public string $password;

    public array $gsmAndMsg;

    public string $header;

    public ?string $encoding;

    public ?string $startdate;

    public ?string $stopdate;

    public ?string $bayikodu;

    public string $filter;

    public ?string $apikey;

    public function __construct(array $phonesAndMessages)
    {
        $this->username = '';
        $this->password = '';
        $this->gsmAndMsg = $phonesAndMessages;
        $this->header = '';
        $this->encoding = null;
        $this->startdate = null;
        $this->stopdate = null;
        $this->bayikodu = null;
        $this->filter = 0;
        $this->apikey = null;
    }


    public function toArray(): array
    {
        $parameters = [];

        foreach (get_object_vars($this) as $key => $value)
        {
            if ($value == '')
                continue;

            if ($key === 'gsmAndMsg')
            {
                foreach ($this->gsmAndMsg as $gsm => $msg) {
                    $parameters[] = [
                        'name' => 'msg',
                        'value' => $msg
                    ];

                    $parameters[] = [
                        'name' => 'gsm',
                        'value' => $gsm
                    ];
                }

                continue;
            }

            $parameters[] = [
                'name' => $key,
                'value' => $value
            ];
        }

        return $parameters;
    }
}