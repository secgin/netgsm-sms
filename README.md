# Netgsm SMS Library For PHP

Netgsm sms işlemleri kütüphanesidir. Bir veya daha fazla numaraya sms göndermek için kullanılabilir.

## Kurulum

```bash
composer require secgin/netgsm-sms
```

### Örnek Kullanım

```php
$config = Config::create([
    'serviceUrl' => 'https://api.netgsm.com.tr',
    'username' => '',
    'password' => '',
    'defaultMessageHeader' => ''
]);
$apiClient = new ApiClient($config);

$request = SendSms::create('5460000000', 'Deneme')
    ->add('5050000000', 'deneme 2');

$result = $apiClient->sendSms($request);
if ($result->isSuccess())
    echo 'Başarılı. jobid:'.$result->jobid;
else
    echo 'Hata! error code: ' . $result->getErrorCode() .' error message: ' . $result->getErrorMessage();
```