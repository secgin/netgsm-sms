<?php

namespace YG\Netgsm\Soap;

use YG\Netgsm\Soap\Response\SendSmsResponse;

interface ClientInterface
{
    /**
     * Mesajı bir veya daha fazla numaraya gönderir.
     *
     * @param string   $message
     * @param string[] $phones ['gsm', 'gsm', ...] formatında bir dizi gönderilir. Numara 10 haneli olmalıdır.
     * @param string[] $params Opsiyonel parametreler.
     *
     * @return SendSmsResponse
     */
    public function send(string $message, array $phones, array $params = []): SendSmsResponse;

    /**
     * Bir veya daha fazla numaraya farklı mesajlar gönderir.
     *
     * @param string[] $phonesAndMessages ['gsm' => 'msg', 'gsm' => 'msg', ...] formatında bir dizi gönderilir.
     *                                    Numara 10 haneli olmalıdır.
     * @param string[] $params            Opsiyonel parametreler.
     *
     * @return SendSmsResponse
     */
    public function sendMultiple(array $phonesAndMessages, array $params = []): SendSmsResponse;
}