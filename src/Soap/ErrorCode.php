<?php

namespace YG\Netgsm\Soap;

final class ErrorCode
{
    const CODES = [
        '20' => 'Mesaj meti hatalı yada maksimum karakter sayısını geçiyor.',
        '30' => 'Geçersiz kullanıcı adı şifre veya ip kısıtlaması var.',
        '40' => 'Mesaj başlığı hatalı.',
        '50' => 'Abone hesabınız ile İYS kontrollü gönderimler yapılamamaktadır.',
        '51' => 'Aboneliğinize tanımlı İYS Marka bilgisi bulunamadığını ifade eder.',
        '70' => 'Hatalı sorgulama. Gönderdiğiniz parametrelerden birisi hatalı veya zorunlu alanlardan birinin eksik.',
        '80' => 'Gönderim sınır aşımı',
        '85' => 'Mükerrer Gönderim sınır aşımı. Aynı numaraya 1 dakika içerisinde 20\'den fazla görev oluşturulamaz.',
        '100' => 'Sistem hatası.',
        '101' => 'Sistem hatası.'
    ];
}