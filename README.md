# Netgsm SMS Library For PHP

Netgsm sms işlemleri kütüphanesidir. Bir veya daha fazla numaraya sms göndermek için kullanılabilir.

## Kurulum

```bash
composer require secgin/netgsm-sms
```

### Örnek Kullanım

```php
use YG\Netgsm\Soap\Client as SoapClient;

require '../vendor/autoload.php';

$soapClient = new SoapClient(
    'username',
    'password',
    'message_header'
);

// Bir veya daha fazla numaraya aynı mesaajı göndermek için
$response = $soapClient->send(
    'Test', 
    [
        '5XXXXXXXXX', 
        '5XXXXXXXX1'
    ]);

// Bir veya daha fazla numara farklı mesaj göndermek için
$response = $soapClient->sendMultiple([
    '5XXXXXXXXX' => 'Test',
    '5XXXXXXXX1' => 'Test 2'
]);

if ($response->isSuccess())
    echo 'Gönderildi. (Mesaj Id: '. $response->messageId . ')';
else
    echo 'Hata: ' . $response->errorMessage . ($response->code);
```

SoapClient sınıfının kurucu metodunun 4. parametresi varsayılan parametreleri göndermek için kullanılır. 

Örneğin: Gönderilen tüm mesajların karakter kodlaması türkçe olması istenirse 'TR' gönderilir. Gönderilen mesajlar İYS kontrolü yapıması istenirse 'filter' parametresi gönderilir. 

Bu varsayılan paramtreler mesaj göndermek için kullanılan 'send' ve 'sendMultiple' metotlarında iptal edilebilir yada değiştirilebilir.
```PHP
$soapClient = new SoapClient(
    'username',
    'password',
    'message_header',
    [
        'filter' => '11',
        'encoding' => 'TR'
    ]);
```
