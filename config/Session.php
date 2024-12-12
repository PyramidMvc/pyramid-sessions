<?php

return [
	// Session ayarları
	'lifetime' => 36000,
	// Session süresi (dakika) Session'nun ömrü (dakika). 0 ise tarayıcı kapandığında silinir

	'session_auto_start' => true,
	// Session oturumunu otomatik başlat

	'expire_on_close' => false,
	// Tarayıcı kapandığında session sonlanmasın

	'encrypt' => true,
	// Session verilerini şifrele

	'files' => repository_path( 'sessions' ),
	// Session dosyalarının kaydedileceği dizin

	'cookie' => null,
	// Cookie ismi

	'path' => '/',
	// Cookie'nin geçerli olduğu yol (domain'e göre)

	'domain' => $_SERVER['HTTP_HOST'],
	// Cookie'nin geçerli olduğu domain. Alt domainlerle birlikte geçerli

	'cookie_lifetime' => 36000,
	// Cookie'nin ömrü

	'driver' => 'database',
	// Session sürücüsü (file, database, memcached, vb.)

	'connection' => null,
	// Veritabanı bağlantısı (database driver kullanıyorsanız)

	'table' => 'sessions',
	// Session verilerini tutacak tablo (database driver kullanıyorsanız)

	'store' => null,
	// Redis gibi bir storage kullanmak isterseniz buraya yazarız

	'secure' => true,
	// SSL kontrolü

	'httponly' => false,
	// JavaScript üzerinden erişilememesi için

	'same_site' => null,
	// Cross-site request'lere karşı güvenlik ('Strict', 'Lax', 'None', null) gibi seçeneklerle cookie'nin cross-site isteklerde nasıl davranacağı belirlenir. 'None' için secure gereklidir.
];
