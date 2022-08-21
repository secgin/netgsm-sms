<?php

namespace YG\Netgsm\Soap\Request;

final class SendSmsRequest extends RequestAbstract
{
    public string $username;

    public string $password;

    public string $msg;

    public array $gsm;

    public string $header;

    public ?string $encoding;

    public ?string $startdate;

    public ?string $stopdate;

    public ?string $bayikodu;

    public string $filter;

    public ?string $apikey;


    public function __construct(string $msg, array $gsm)
    {
        $this->username = '';
        $this->password = '';
        $this->msg = $msg;
        $this->gsm = $gsm;
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

            if ($key === 'gsm')
            {
                array_push($parameters, ...array_map(function($gsm) {
                    return [
                        'name' => 'gsm',
                        'value' => $gsm
                    ];
                }, $this->gsm));

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