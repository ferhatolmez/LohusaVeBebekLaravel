<div align="center">

<br/>

```
██╗      ██████╗ ██╗  ██╗██╗   ██╗███████╗ █████╗
██║     ██╔═══██╗██║  ██║██║   ██║██╔════╝██╔══██╗
██║     ██║   ██║███████║██║   ██║███████╗███████║
██║     ██║   ██║██╔══██║██║   ██║╚════██║██╔══██║
███████╗╚██████╔╝██║  ██║╚██████╔╝███████║██║  ██║
╚══════╝ ╚═════╝ ╚═╝  ╚═╝ ╚═════╝ ╚══════╝╚═╝  ╚═╝
```

# Lohusa & Bebek İzlem Platformu

**Klinik akışı destekleyen, rol tabanlı, API-first sağlık takip sistemi**

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![License](https://img.shields.io/badge/Lisans-MIT-22c55e?style=flat-square)](LICENSE)
[![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=flat-square&logo=docker&logoColor=white)](docker-compose.yml)
[![Tests](https://img.shields.io/badge/Tests-Pest-F9322C?style=flat-square)](tests/)
[![Sanctum](https://img.shields.io/badge/Auth-Sanctum-EF4444?style=flat-square)](https://laravel.com/docs/sanctum)

<br/>

> 🏥 Doğum sonrası anne ve bebek takibini tek çatı altında toplayan,  
> gerçek klinik akışına göre tasarlanmış modern bir sağlık yönetim platformu.

<br/>

---

</div>

## ✦ Neden Bu Proje?

Doğum sonrası dönem, hem anne hem bebek için kritik bir süreçtir — ancak çoğu klinik bu süreci hâlâ kağıt formlar veya dağınık spreadsheet'lerle yönetmektedir.

**Lohusa & Bebek İzlem Platformu**, ebe ve klinisyenlerin bu süreci dijital, ölçülebilir ve güvenli biçimde yönetmesini sağlar. Rol bazlı erişim, API entegrasyonu ve PDF raporlama ile sahaya da, sisteme de hazır.

<br/>

## ✦ Öne Çıkan Özellikler

| Özellik | Detay |
|---|---|
| 🔐 **Rol Tabanlı Yetkilendirme** | `admin`, `ebe`, `student` rolleri — Spatie Permission |
| 📋 **Çok Adımlı Form Akışı** | Klinik, psikolojik ve sosyal alanları kapsayan kayıt sihirbazı |
| 📊 **Akıllı Dashboard** | Yaklaşan kontroller, tamamlılık skoru, özet metrikler |
| 📄 **PDF Raporlama** | DomPDF + Türkçe karakter desteği (DejaVu Sans) |
| 🔌 **REST API** | Laravel Sanctum korumalı, JsonResource çıktılı API v1 |
| 🧪 **Test Otomasyonu** | Pest ile feature & unit testler, CI entegrasyonu |
| 🐳 **Docker Hazır** | Tek komutla ayağa kalkan geliştirme ortamı |
| 💾 **Tarayıcı Taslak** | Form kayıplarını önleyen otomatik taslak sistemi |

<br/>

## ✦ Sistem Mimarisi

```
┌─────────────────────────────────────────────────────────────┐
│                        İSTEK AKIŞI                          │
├─────────────────────┬───────────────────────────────────────┤
│    Web Arayüzü      │         API v1 / Sanctum              │
│    (Blade + BS5)    │      (token tabanlı erişim)           │
└────────┬────────────┴──────────────────┬────────────────────┘
         │                               │
         ▼                               ▼
┌─────────────────────────────────────────────────────────────┐
│              Web & API Controller Katmanı                   │
│         Policy · Permission · Middleware · Auth             │
└─────────────────────────────────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────────┐
│                    Service Katmanı                          │
│       İş mantığı · Validasyon · Hesaplama motoru            │
└─────────────────────────────────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────────┐
│                  Repository Katmanı                         │
│          Veri erişimi · Sorgular · Eloquent ORM             │
└─────────────────────────────────────────────────────────────┘
                          │
                          ▼
         ┌────────────────────────────────┐
         │   MySQL · SQLite · PostgreSQL  │
         └────────────────────────────────┘
```

<br/>

## ✦ Modüller

<details>
<summary><strong>📊 Dashboard</strong></summary>
<br/>

- Toplam lohusa ve bebek kayıt sayısı
- Yaklaşan takip tarihleri (bugün / bu hafta)
- Tamamlılık skoru ve kalite göstergeleri
- Beslenme ve termin dağılımı özet grafikleri

</details>

<details>
<summary><strong>🤱 Lohusa İzlem Modülü</strong></summary>
<br/>

- Çok adımlı kayıt sihirbazı (klinik → psikolojik → sosyal)
- Otomatik takip önerisi ve tamamlılık puanı
- Tarayıcı taslak kaydı ile form güvenliği
- PDF rapor çıktısı

</details>

<details>
<summary><strong>👶 Bebek İzlem Modülü</strong></summary>
<br/>

- Klinik muayene ve gelişim alanları
- İzlem sayısına göre otomatik sonraki kontrol tarihi hesabı
- Gelişmiş listeleme ve filtreleme
- PDF raporlama

</details>

<details>
<summary><strong>🔌 API Katmanı</strong></summary>
<br/>

- Token tabanlı kimlik doğrulama (Sanctum)
- Lohusa ve bebek kaynakları için tam CRUD
- JsonResource ile standart, sürümlü çıktı
- `api/v1` prefix ile versiyonlama

</details>

<br/>

## ✦ Teknoloji Yığını

```
Backend       →  PHP 8.2 + Laravel 12
Auth          →  Laravel Sanctum (API) + Session (Web)
Yetkilendirme →  Spatie Laravel Permission
PDF           →  Barryvdh DomPDF (Türkçe: DejaVu Sans)
Test          →  Pest (Feature + Unit)
Frontend      →  Bootstrap 5 + Blade
Veritabanı    →  MySQL / SQLite / PostgreSQL
Container     →  Docker Compose
CI            →  GitHub Actions
```

<br/>

## ✦ Kurulum

### 🖥 Yerel Geliştirme

```bash
# 1. Klonla
git clone https://github.com/ferhatolmez/LohusaVeBebekLaravel.git
cd LohusaVeBebekLaravel

# 2. Bağımlılıkları yükle
composer install
npm install

# 3. Ortam ayarları
cp .env.example .env
php artisan key:generate

# 4. Veritabanı kur ve seed et
php artisan migrate --seed

# 5. Frontend derle ve başlat
npm run build
php artisan serve
```

### 🐳 Docker ile Çalıştır

```bash
docker compose up --build
```

| Servis | Adres |
|--------|-------|
| Web Uygulaması | http://localhost:8080 |
| MySQL | 127.0.0.1:33060 |

<br/>

## ✦ Demo Hesaplar

```
👤 admin@example.com   →  password   (Tam yetki)
👤 ebe@example.com     →  password   (Klinik modüller)
👤 student@example.com →  password   (Salt okunur)
```

<br/>

## ✦ API Kullanımı

### Token Al

```bash
curl -X POST http://127.0.0.1:8000/api/v1/auth/token \
  -H "Accept: application/json" \
  -d "email=ebe@example.com" \
  -d "password=password" \
  -d "device_name=postman"
```

### Lohusa Kayıtlarını Listele

```bash
curl http://127.0.0.1:8000/api/v1/lohusa \
  -H "Authorization: Bearer <TOKEN>" \
  -H "Accept: application/json"
```

### Bebek Kaydı Oluştur

```bash
curl -X POST http://127.0.0.1:8000/api/v1/bebek \
  -H "Authorization: Bearer <TOKEN>" \
  -H "Accept: application/json" \
  -d "dogum_tarihi=2025-01-15" \
  -d "kac_haftalik=40" \
  -d "muayene_tarihi=2025-01-20" \
  -d "izlem_sayisi=1" \
  -d "termin_durumu=Term" \
  -d "cinsiyet=Erkek"
```

<br/>

## ✦ Test & Kalite

```bash
# Testleri çalıştır
composer test

# Kod stili kontrolü
composer lint
```

> ⚠️ Testlerin tam çalışması için `pdo_sqlite` uzantısı etkin olmalıdır.

CI pipeline'ı sırasıyla şunları yapar:
1. Composer bağımlılıklarını yükler
2. Frontend build alır
3. Laravel Pint ile kod stili doğrular
4. Pest test süitini tetikler

<br/>

## ✦ Dağıtım

### Render

Projenin kök dizinindeki `Dockerfile`, Render platformu için hazır yapılandırılmıştır. PostgreSQL tabanlı örnek servis tanımı için [`render.yaml`](render.yaml) dosyasını inceleyin.

Dağıtım sonrası zorunlu ortam değişkenleri:

```env
APP_KEY=
APP_URL=
DB_CONNECTION=pgsql
DATABASE_URL=
```

<br/>

## ✦ Dizin Yapısı

```
app/
├── Http/
│   ├── Controllers/     # Web & API controller'lar
│   ├── Requests/        # Form validasyon sınıfları
│   └── Resources/       # API JsonResource çıktıları
├── Models/              # Eloquent modelleri
├── Policies/            # Yetkilendirme policy'leri
├── Repositories/        # Veri erişim katmanı
└── Services/            # İş mantığı katmanı
resources/
└── views/               # Blade şablonları
routes/                  # Web & API route tanımları
tests/                   # Pest test süitleri
```

<br/>

---

<div align="center">

**Geliştirici** · [Ferhat Ölmez](https://github.com/ferhatolmez)

*MIT Lisansı · Katkılara açık · Yıldız atmayı unutma ⭐*

</div>
