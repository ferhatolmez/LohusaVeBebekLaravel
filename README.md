<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <strong>👩‍⚕️ Lohusa ve Bebek İzlem Uygulaması</strong>
</p>

<p align="center">
  <em>Ebe ve sağlık profesyonelleri için tam donanımlı, çok adımlı formlar ve PDF rapor desteği sunan modern bir Sağlık Takip Platformu</em>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/LARAVEL-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-5.7+-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/DomPDF-PDF%20Export-FF2D20?style=for-the-badge" alt="DomPDF">
  <img src="https://img.shields.io/badge/Vite-Build%20Tool-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Atatürk%20Üniversitesi-Sağlık%20Bilimleri%20Fakültesi%20Ebelik%20Bölümü-0066CC?style=flat-square" alt="Atatürk Üniversitesi">
</p>

---

## 📋 Proje Hakkında

Bu proje, **Atatürk Üniversitesi Sağlık Bilimleri Fakültesi Ebelik Bölümü** bağlamında tasarlanmış bir **Lohusa ve Bebek İzlem Sistemi**dir. Lohusa (postpartum) kadın ve yenidoğan bebeklerin sistematik olarak izlenmesini sağlayan, çok adımlı formlar ve PDF çıktı desteği sunan **Laravel 12** tabanlı bir web uygulamasıdır.

Uygulama; ebe ve sağlık profesyonellerinin sahadaki klinik değerlendirmelerini standartlaştırmayı, veriyi düzenli biçimde saklamayı ve gerektiğinde **tek tıkla rapor almayı** hedefler.

---

## ✨ Öne Çıkan Özellikler

### 👩‍🍼 Lohusa İzlem Formu

- **16 adımlı** çok sayfalı form yapısı (tanıtıcı bilgiler, obstetrik öykü, aile ve sosyal durum, konut ve hijyen, menstrüel geçmiş, postpartum durum, emzirme ve psikolojik değerlendirme vb.)
- Geniş alan yelpazesi: **anamnez**, **vital bulgular**, **fizik muayene**, beslenme alışkanlıkları, aile planlaması, ebe yorumu
- İlgili alanlar **JSON** yapısında saklanarak esnek ve genişletilebilir model

### 🧒 Bebek İzlem Formu

- Doğum ve muayene tarihleri, **termin durumu**, vital bulgular (ateş, nabız, solunum, kilo, boy, baş/göğüs çevresi)
- Sistem bazlı fizik muayene: deri, baş, göz, burun, ağız, kulak, boyun, göğüs, abdomen, kasık, genital, solunum sistemi, KVS, GIS, üriner sistem, kas-iskelet, nörolojik

### 📄 PDF Çıktı Alma

- **barryvdh/laravel-dompdf** ile hem lohusa hem bebek formları için **tek tıkla PDF** üretimi
- Türkçe karakter desteği (DejaVu Sans font)

### 📱 Modern ve Responsive Arayüz

- **Bootstrap 5** tabanlı, mobil uyumlu tasarım
- Profesyonel navbar, kart yapıları ve tablo görünümleri
- Gradient arka planlar ve kullanıcı dostu butonlar

### 🔧 Kayıt Yönetimi

- Lohusa ve bebek kayıtları listelenebilir, detay sayfasından görüntülenebilir
- Lohusa kayıtları **güvenli silme** ile yönetilebilir
- Anasayfada **son kayıtlar** hızlı erişim listesi

---

## 🗺️ Ekran Akışı

| Rota | Açıklama |
|------|----------|
| `/` | Ana sayfa – Lohusa/Bebek form seçimi, son kayıtlar |
| `/lohusa` | Lohusa form listesi – Detay, PDF, Sil |
| `/lohusa/create` | 16 adımlı Lohusa form oluşturma |
| `/bebek` | Bebek form listesi |
| `/bebek/create` | Bebek form oluşturma |

---

## 🛠️ Teknolojiler ve Mimarî

| Katman | Teknoloji |
|--------|-----------|
| **Backend** | Laravel 12, PHP 8.2+, MySQL |
| **PDF** | barryvdh/laravel-dompdf |
| **Frontend** | Bootstrap 5, Vite, Tailwind CSS |
| **Test** | Pest, Laravel Testing |

### 📁 Temel Dizinler

```
app/Http/Controllers/
├── LohusaFormController.php   # Lohusa CRUD, PDF, son kayıtlar
└── BebekFormController.php     # Bebek CRUD, PDF

app/Models/
├── LohusaForm.php
└── BebekForm.php

resources/views/
├── welcome.blade.php           # Ana sayfa
├── lohusa/                     # Lohusa formları
│   ├── index, create, show
│   └── steps/                  # 16 adımlı form parçaları
└── bebek/                      # Bebek formları
```

---

## 🚀 Kurulum

### Gereksinimler

- PHP 8.2+
- Composer
- Node.js & npm
- MySQL 5.7+

### Adımlar

```bash
# 1. Klonla
git clone https://github.com/ferhatolmez/LohusaVeBebekLaravel.git
cd LohusaVeBebekLaravel

# 2. Ortam dosyası
cp .env.example .env
# .env içinde DB_DATABASE, DB_USERNAME, DB_PASSWORD güncelle

# 3. Bağımlılıklar
composer install
php artisan key:generate

# 4. Veritabanı
php artisan migrate

# 5. Frontend
npm install
```

### Çalıştırma

```bash
# Tek komutla (Laravel + Queue + Vite)
composer run dev

# veya ayrı ayrı
php artisan serve
npm run dev
```

---

## 🧪 Testler

```bash
php artisan test
# veya
composer test
```

**Mevcut testler:** `LohusaFormTest`, `BebekFormTest` – Ana sayfa, form CRUD, validation, PDF indirme, silme

---

## 🌐 Canlıya Alma

### GitHub

Proje zaten public repoda. Yeni repo için:

```bash
git remote add origin https://github.com/<kullanici>/<repo>.git
git push -u origin main
```

### Render / PaaS

`render.yaml` ve `Dockerfile` mevcut. Render’a bağlayıp environment değişkenlerini tanımlayın, `php artisan migrate --force` çalıştırın.

### Shared Hosting

`public` klasörünü document root yapın, `.env` düzenleyin, `composer install` ve `php artisan migrate --force` çalıştırın.

---

## ⚠️ Güvenlik ve KVKK

Bu projede **kişisel sağlık verisi** alanları bulunur. Gerçek veri kullanımında:

- **SSL (HTTPS)** zorunlu
- Veritabanı erişim yetkileri minimum seviyede
- Portföy/demo için anonimleştirilmiş veri önerilir

---

## 📄 Lisans

MIT Lisansı ile lisanslanmıştır.

---

<p align="center">
  <strong>Geliştiren:</strong> <a href="https://github.com/ferhatolmez">Ferhat ÖLMEZ</a>
</p>
