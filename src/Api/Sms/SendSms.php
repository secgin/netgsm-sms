<?php

namespace YG\Netgsm\Api\Sms;

use YG\ApiLibraryBase\Abstracts\Request\AbstractRequest;

final class SendSms extends AbstractRequest
{
    /**
     * @param string $phone         SMSin gönderileceği gsm numarasıdır. Eğer yurtdışı telefon numarasına mesaj
     *                              göndermek istiyorsanız numaranın başına 00 ekleyerek gönderim işlemini
     *                              yapabilirsiniz.
     * @param string $message       Mesaj metnidir. Tarifenizdeki maksimum karakterden uzun olmamalıdır. Standart
     *                              maksimum karakter 917 dur.
     * @param string $messageHeader Sistemde tanımlı olan mesaj başlığınızdır (gönderici adınız). En az 3, en fazla 11
     *                              karakterden oluşur. Eğer mesaj başlığınızın abone numaranızın olmasını
     *                              istiyorsanız, bu parametreye başında sıfır olmadan abone numaranızı
     *                              yazınız.8xxxxxxxxxx
     *
     *                              Boş bırakılırsa varsayılan mesaj başlığı kullanılır
     *
     * @return self
     */
    public static function create(string $phone, string $message, string $messageHeader = ''): self
    {
        return new self([
            'msgheader' => $messageHeader,
            'messages' => [
                [
                    'msg' => $message,
                    'no' => $phone
                ]
            ],
            'encoding' => 'TR',
            'iysfilter' => '0'
        ]);
    }

    /**
     * @param string $startDate Gönderime başlayacağınız tarih. (ddMMyyyyHHmm) * Boş bırakılırsa mesajınız hemen gider.
     *
     * @return $this
     */
    public function setStartDate(string $startDate): self
    {
        $this->setParam('startdate', $startDate);
        return $this;
    }

    /**
     * @param string $stopDate İki tarih arası gönderimlerinizde bitiş tarihi.(ddMMyyyyHHmm) * Boş bırakılırsa sistem
     *                         başlangıç tarihine 21 saat ekleyerek otomatik gönderir.
     *
     * @return $this
     */
    public function setStopDate(string $stopDate): self
    {
        $this->setParam('stopdate', $stopDate);
        return $this;
    }

    /**
     * @param string $encoding Türkçe karakterli mesaj gönderimlerinizde "TR" gönderilir. Eğer gönderim sağlanmazsa
     *                         mesajınız Türkçe karakter içermeden gönderilecektir.
     *
     * @return $this
     */
    public function setEncoding(string $encoding): self
    {
        $this->setParam('encoding', $encoding);
        return $this;
    }

    /**
     * @param string $iysFilter Ticari içerikli SMS gönderimlerinde bu parametreyi kullanabilirsiniz. Ticari içerikli
     *                          bireysele gönderilecek numaralar için İYS kontrollü gönderimlerde ise "11" değerini,
     *                          tacire gönderilecek İYS kontrollü gönderimlerde ise "12" değerini almalıdır.
     *                          Bilgilendirme amaçlı gönderilen içeriklerde (İYS kontrolü sağlanmadan gönderilen) "0"
     *                          değerini almalıdır.
     *
     * @return $this
     */
    public function setIysFilter(string $iysFilter): self
    {
        $this->setParam('iysfilter', $iysFilter);
        return $this;
    }

    /**
     * @param string $partnerCode Bayi üyesi iseniz bayinize ait kod gönderilebilir.
     *
     * @return $this
     */
    public function setPartnerCode(string $partnerCode): self
    {
        $this->setParam('partnercode', $partnerCode);
        return $this;
    }

    /**
     * @param string $appName Uygulamanızın ismi.
     *
     * @return $this
     */
    public function setAppName(string $appName): self
    {
        $this->setParam('appname', $appName);
        return $this;
    }

    /**
     * @param string $referansId Her isteğe özel olarak istemci (client) tarafından oluşturulabilir ve API isteğine
     *                           eklenebilir (Zorunlu değil). Bu, mesaj gönderiminin daha sonra takip edilebilmesini
     *                           sağlar.
     *
     * @return $this
     */
    public function setReferansId(string $referansId): self
    {
        $this->setParam('referansID', $referansId);
        return $this;
    }

    public function add(string $phone, string $message): self
    {
        $messages = $this->getParam('messages');
        $messages[] = [
            'msg' => $message,
            'no' => $phone
        ];
        $this->setParam('messages', $messages);
        return $this;
    }
}