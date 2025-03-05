# MVC Framework Projesi
# Proje Sahibi: Cihat Cetin

Bu proje, herhangi bir framework veya hazır paket kullanmadan yazılmış bir MVC yapısı sunmaktadır.

## Özellikler

### Routing
- Route URI'da parametre desteği (`/user/{id}`)
- Route URI'da opsiyonel parametre desteği (`/user/{id?}`)
- Route URI'da pattern/regex desteği (`/user/{\d+}`)
- Çoklu parametre desteği (`/blog/{id}/translations/{language_id}`)

### Middleware
- Controller çalıştırılmadan önce middleware desteği
- Route bazlı middleware tanımlama
- Basit middleware yapısı

### Controller & View
- Template engine desteği
- View path ve değişken passing desteği
- Basit ve anlaşılır view yapısı
- Esnek view dosya uzantısı desteği (.php, .html, vb.)
- Akıllı hata mesajı sistemi (Login işleminde)
  - Kullanıcı adı hatalıysa: "Kullanıcı adı hatalı!"
  - Şifre hatalıysa: "Şifre hatalı!"
  - Her ikisi de hatalıysa: "Kullanıcı adı ve şifre hatalı!"

### Response Types
- HTML/Text response desteği
- JSON response desteği (array/object dönüşlerinde otomatik)
- Content-Type header otomatik ayarlama

### Database
- PDO tabanlı basit database bağlantısı
- Statik DB sınıfı ile kolay erişim
- Query parametre desteği

## URL Yapısı

### Public URLs (Giriş Gerektirmez)
1. **Ana Sayfa**
   - URL: `/`
   - Method: GET
   - Response: HTML

2. **Giriş Sayfası**
   - Form Gösterimi:
     - URL: `/login`
     - Method: GET
     - Response: HTML
   - Giriş İşlemi:
     - URL: `/login`
     - Method: POST
     - Response: 302 Redirect (başarılı) veya HTML (hata mesajı ile birlikte)
     - Not: Hatalı giriş durumunda spesifik hata mesajı gösterilir

### Protected URLs (Giriş Gerektirir)
1. **Kullanıcı Profili**
   - URL: `/user/{id}`
   - Method: GET
   - Response: HTML veya JSON (?format=json)
   - Not: AuthMiddleware koruması altında

2. **Blog İşlemleri**
   - Blog Detay:
     - URL: `/blog/{id}`
     - Method: GET
     - Response: HTML veya JSON
   - Blog Çevirileri:
     - URL: `/blog/{id}/translations/{language_id}`
     - Method: GET
     - Response: HTML veya JSON
     - Örnek: `/blog/1/translations/tr` veya `/blog/1/translations/en`

3. **Çıkış**
   - URL: `/logout`
   - Method: GET
   - Response: 302 Redirect -> /login
   - Not: AuthMiddleware koruması altında

## Kurulum

1. Composer'ı yükleyin:
```bash
composer install
```

2. `.env` dosyasını oluşturun:
```env
DB_HOST=localhost
DB_NAME=test
DB_USER=root
DB_PASS=
```

3. Web sunucusunu başlatın:
```bash
php -S localhost:8000 -t public/
```

## Test Senaryosu

1. `/login` sayfasına git
2. Giriş yap (kullanıcı adı/şifre ile)
   - Hatalı giriş durumunda spesifik hata mesajı görüntülenir
   - Başarılı girişte ana sayfaya yönlendirilir
3. Ana sayfaya yönlendirilir (/)
4. Kullanıcı profilini görüntüle (/user/1)
   - HTML formatı: `/user/1`
   - JSON formatı: `/user/1?format=json`
5. Blog işlemlerini test et
   - Blog detayı: `/blog/1`
   - Blog Türkçe çevirisi: `/blog/1/translations/tr`
   - Blog İngilizce çevirisi: `/blog/1/translations/en`
6. Çıkış yap (/logout)
7. Login sayfasına geri yönlendirilir

## Test Kullanıcı Bilgileri
```
Kullanıcı Adı: cihat
Şifre: 123456
```

## Dizin Yapısı
```
├── app/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── BlogController.php
│   │   ├── HomeController.php
│   │   └── UserController.php
│   └── Middleware/
├── core/
│   ├── Controller.php
│   ├── DB.php
│   ├── Middleware.php
│   └── Router.php
├── public/
│   ├── .htaccess
│   └── index.php
├── views/
│   ├── auth/
│   ├── blog/
│   ├── home/
│   └── user/
├── .env
├── composer.json
└── README.md
```

