<?php

namespace YG\Netgsm\Soap;

final class Curl
{
    public static function execute(array $curlParams): string
    {
        $curl = curl_init();
        curl_setopt_array($curl, $curlParams);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}