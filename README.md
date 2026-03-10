<div align="center">

<br/>

<img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12"/>
<img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2"/>
<img src="https://img.shields.io/badge/Auth-Sanctum-EF4444?style=for-the-badge" alt="Sanctum"/>
<img src="https://img.shields.io/badge/Tests-Pest-F9322C?style=for-the-badge" alt="Pest"/>
<img src="https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker"/>
<img src="https://img.shields.io/badge/License-MIT-22c55e?style=for-the-badge" alt="MIT"/>

<br/><br/>

# 🏥 Lohusa & Bebek İzlem Platformu

**Doğum sonrası anne ve bebek takibini tek çatı altında toplayan,**
**klinik akışına göre tasarlanmış modern sağlık yönetim sistemi.**

<br/>

<a href="#-kurulum">Kurulum</a> ·
<a href="#-api-kullanımı">API</a> ·
<a href="#-test--kalite">Testler</a> ·
<a href="#-dağıtım">Dağıtım</a>

<br/>

---

</div>

## 📋 İçindekiler

- [Proje Hakkında](#-proje-hakkında)
- [Öne Çıkan Özellikler](#-öne-çıkan-özellikler)
- [Sistem Mimarisi](#-sistem-mimarisi)
- [Teknoloji Yığını](#-teknoloji-yığını)
- [Modüller](#-modüller)
- [Kurulum](#-kurulum)
- [Kullanıma Başlama](#-kullanıma-başlama)
- [API Kullanımı](#-api-kullanımı)
- [Test & Kalite](#-test--kalite)
- [Dağıtım](#-dağıtım)
- [Dizin Yapısı](#-dizin-yapısı)
- [Katkıda Bulunma](#-katkıda-bulunma)
- [Lisans](#-lisans)

<br/>

## 💡 Proje Hakkında

Doğum sonrası dönem, hem anne hem bebek için kritik bir süreçtir — ancak çoğu klinik bu süreci hâlâ kağıt formlar veya dağınık spreadsheet'lerle yönetmektedir.

**Lohusa & Bebek İzlem Platformu**, ebe ve klinisyenlerin bu süreci **dijital, ölçülebilir ve güvenli** biçimde yönetmesini sağlar:

- 🔐 **Rol bazlı erişim** — admin, ebe, öğrenci rolleri ile yetkilendirme
- 📊 **Akıllı dashboard** — yaklaşan kontroller, tamamlılık skoru, klinik metriklerin tümü tek ekranda
- 📄 **PDF raporlama** — DomPDF ile Türkçe karakter destekli raporlar
- 🔌 **REST API** — Sanctum korumalı, versiyonlu API çıktısı
- 🧪 **Test altyapısı** — Pest framework ile kapsamlı test desteği

<br/>

## ✨ Öne Çıkan Özellikler

| Kategori | Özellik | Detay |
|:---|:---|:---|
| **Güvenlik** | Rol tabanlı yetkilendirme | Spatie Permission ile `admin`, `ebe`, `student` rolleri |
| **Klinik** | Çok adımlı form sihirbazı | 16 adımlık kayıt akışı (klinik → psikolojik → sosyal) |
| **Dashboard** | Akıllı metrikler | Yaklaşan kontroller, tamamlılık skoru, dağılım grafikleri |
| **Raporlama** | PDF çıktı | DomPDF + Türkçe karakter desteği (DejaVu Sans) |
| **API** | REST API v1 | Sanctum korumalı, JsonResource çıktılı, versiyonlu |
| **Test** | Pest otomasyonu | Feature & Unit testler, CI entegrasyonu |
| **DevOps** | Docker hazır | `docker compose up` ile tek komutla ayağa kalkma |
| **UX** | Tarayıcı taslağı | Form verisi kaybını önleyen otomatik kaydetme |
| **Takip** | Otomatik kontrol hesabı | Postpartum gün/hafta verisine göre takip tarihi önerisi |

<br/>

## 🏗 Sistem Mimarisi

```
┌──────────────────────────────────────────────────────────────────┐
│                         İSTEK AKIŞI                              │
├──────────────────────┬───────────────────────────────────────────┤
│     Web Arayüzü      │           API v1 / Sanctum                │
│   (Blade + BS5 +     │        (Token tabanlı erişim)             │
│    Glassmorphism)     │                                          │
└─────────┬────────────┴──────────────────┬────────────────────────┘
          │                               │
          ▼                               ▼
┌──────────────────────────────────────────────────────────────────┐
│                Web & API Controller Katmanı                      │
│          Policy · Permission · Middleware · Auth                  │
└──────────────────────────────────────────────────────────────────┘
                          │
                          ▼
┌──────────────────────────────────────────────────────────────────┐
│                      Service Katmanı                             │
│         İş mantığı · Validasyon · Hesaplama motoru               │
└──────────────────────────────────────────────────────────────────┘
                          │
                          ▼
┌──────────────────────────────────────────────────────────────────┐
│                    Repository Katmanı                             │
│            Veri erişimi · Sorgular · Eloquent ORM                │
└──────────────────────────────────────────────────────────────────┘
                          │
                          ▼
           ┌─────────────────────────────────┐
           │   MySQL · SQLite · PostgreSQL   │
           └─────────────────────────────────┘
```

> Proje, katmanlı mimari (Controller → Service → Repository) prensibiyle tasarlanmıştır. Bu yapı, iş mantığının test edilebilirliğini ve bakım kolaylığını artırır.

<br/>

## 🛠 Teknoloji Yığını

| Katman | Teknoloji |
|:---|:---|
| **Backend** | PHP 8.2 + Laravel 12 |
| **Kimlik Doğrulama** | Laravel Sanctum (API) + Session (Web) |
| **Yetkilendirme** | Spatie Laravel Permission |
| **PDF** | Barryvdh DomPDF (DejaVu Sans — Türkçe) |
| **Test** | Pest (Feature + Unit) |
| **Frontend** | Bootstrap 5 + Blade + Lucide Icons |
| **Tasarım** | Glassmorphism + Outfit & Inter font ailesi |
| **Veritabanı** | MySQL / SQLite / PostgreSQL |
| **Container** | Docker Compose |
| **CI/CD** | GitHub Actions |

<br/>

## 📦 Modüller

<details>
<summary><strong>📊 Dashboard</strong></summary>
<br/>

- Toplam lohusa ve bebek kayıt sayısı
- Yaklaşan takip tarihleri (bugün / bu hafta) ile renk kodlu uyarılar
- Tamamlılık skoru ve kalite göstergeleri
- Beslenme ve termin dağılımı özet grafikleri
- Son eklenen kayıtların hızlı önizlemesi

</details>

<details>
<summary><strong>🤱 Lohusa İzlem Modülü</strong></summary>
<br/>

- 16 adımlı çok adımlı kayıt sihirbazı (klinik → psikolojik → sosyal)
- Otomatik takip önerisi ve postpartum gün/hafta bazlı hesaplama
- Tarayıcı taslak kaydı ile form güvenliği (LocalStorage)
- Gelişmiş filtreleme: doğum yeri, beslenme, postpartum hafta, tarih aralığı
- PDF rapor çıktısı (DomPDF)

</details>

<details>
<summary><strong>👶 Bebek İzlem Modülü</strong></summary>
<br/>

- Klinik muayene ve gelişim alanları (16 fiziksel muayene kategorisi)
- İzlem sayısına göre otomatik sonraki kontrol tarihi hesabı
- Cinsiyet, termin durumu ve izlem seviyesine göre filtreleme
- Düzenleme ve güncelleme desteği
- PDF raporlama

</details>

<details>
<summary><strong>🔌 API Katmanı (v1)</strong></summary>
<br/>

- Token tabanlı kimlik doğrulama (Sanctum)
- Lohusa ve bebek kaynakları için tam CRUD
- JsonResource ile standart, sürümlü çıktı
- `api/v1` prefix ile versiyonlama
- Pagination ve filtreleme desteği

</details>

<br/>

## 🚀 Kurulum

### Ön Koşullar

- PHP ≥ 8.2 (`pdo_sqlite` uzantısı testler için gerekli)
- Composer
- Node.js ≥ 18 + npm
- MySQL, PostgreSQL veya SQLite

### Yerel Geliştirme

```bash
# 1. Projeyi klonla
git clone https://github.com/ferhatolmez/LohusaVeBebekLaravel.git
cd LohusaVeBebekLaravel

# 2. PHP bağımlılıklarını yükle
composer install

# 3. Node bağımlılıklarını yükle
npm install

# 4. Ortam dosyasını oluştur ve uygulama anahtarını üret
cp .env.example .env
php artisan key:generate

# 5. .env dosyasında veritabanı bağlantı bilgilerini düzenle
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_DATABASE=lohusa_izlem
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Veritabanını oluştur ve seed et
php artisan migrate --seed

# 7. Frontend varlıklarını derle ve sunucuyu başlat
npm run build
php artisan serve
```

> 🌐 Uygulama varsayılan olarak `http://localhost:8000` adresinde çalışır.

### Docker ile Çalıştırma

```bash
docker compose up --build
```

| Servis | Adres |
|:---|:---|
| Web Uygulaması | `http://localhost:8080` |
| MySQL | `127.0.0.1:33060` |

<br/>

## 👤 Kullanıma Başlama

### İlk Admin Hesabı

Proje `migrate --seed` komutu ile çalıştırıldığında, varsayılan rolleri ve izinleri oluşturur. Admin kullanıcı oluşturmak için seed dosyasını kullanabilirsiniz:

```bash
php artisan db:seed
```

Varsayılan demo hesaplar aşağıdaki gibidir:

| Rol | E-posta | Şifre | Yetkiler |
|:---|:---|:---|:---|
| **Admin** | `admin@example.com` | `password` | Tam yetki |
| **Ebe** | `ebe@example.com` | `password` | Klinik modüller (CRUD) |
| **Öğrenci** | `student@example.com` | `password` | Salt okunur erişim |

### Test Yol Haritası

1. **Dashboard** → Giriş yapın, metrikleri ve yaklaşan kontrolleri inceleyin
2. **Lohusa Formu** → Yeni kayıt oluşturun, çok adımlı formu test edin
3. **Bebek Formu** → Bebek kaydı oluşturun, düzenleme ve PDF çıktısını deneyin
4. **Filtreleme** → Liste sayfalarında filtre kombinasyonlarını test edin
5. **API** → Token alın, lohusa/bebek endpoint'lerini Postman ile test edin
6. **Roller** → Farklı roller ile giriş yaparak yetki kontrolünü doğrulayın

<br/>

## 🔌 API Kullanımı

### Token Alma

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

### API Endpoint Özeti

| Metod | Endpoint | Açıklama |
|:---|:---|:---|
| `POST` | `/api/v1/auth/token` | Token üretme |
| `GET` | `/api/v1/lohusa` | Lohusa listesi (paginated) |
| `POST` | `/api/v1/lohusa` | Yeni lohusa kaydı |
| `GET` | `/api/v1/lohusa/{id}` | Lohusa detayı |
| `PUT` | `/api/v1/lohusa/{id}` | Lohusa güncelleme |
| `DELETE` | `/api/v1/lohusa/{id}` | Lohusa silme |
| `GET` | `/api/v1/bebek` | Bebek listesi (paginated) |
| `POST` | `/api/v1/bebek` | Yeni bebek kaydı |
| `GET` | `/api/v1/bebek/{id}` | Bebek detayı |
| `PUT` | `/api/v1/bebek/{id}` | Bebek güncelleme |
| `DELETE` | `/api/v1/bebek/{id}` | Bebek silme |

<br/>

## 🧪 Test & Kalite

```bash
# Testleri çalıştır
composer test

# Veya doğrudan Pest ile
./vendor/bin/pest

# Kod stili kontrolü (Laravel Pint)
composer lint
```

> ⚠️ Testlerin tam çalışması için `pdo_sqlite` PHP uzantısı etkin olmalıdır.

### CI Pipeline

CI/CD süreci (GitHub Actions) sırasıyla şunları yapar:

1. ✅ Composer bağımlılıklarını yükler ve cache'ler
2. ✅ Frontend build alır (`npm ci && npm run build`)
3. ✅ Laravel Pint ile kod stili doğrular
4. ✅ Pest test süitini tetikler (SQLite in-memory)

<br/>

## 🌍 Dağıtım

### Render

Projenin kök dizinindeki `Dockerfile`, Render platformu için hazır yapılandırılmıştır. PostgreSQL tabanlı örnek servis tanımı için [`render.yaml`](render.yaml) dosyasını inceleyin.

#### Gerekli Ortam Değişkenleri

```env
APP_KEY=base64:...
APP_URL=https://your-app.onrender.com
APP_ENV=production
DB_CONNECTION=pgsql
DATABASE_URL=postgresql://user:pass@host:5432/dbname
```

#### Dağıtım Sonrası

```bash
# Render build betiği otomatik olarak çalıştırır:
# 1. composer install --no-dev
# 2. npm ci && npm run build
# 3. php artisan migrate --force
# 4. php artisan config:cache
# 5. php artisan route:cache
```

<br/>

## 📁 Dizin Yapısı

```
LohusaVeBebekLaravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/         # Web & API controller'lar
│   │   │   ├── Api/             # API v1 controller'ları
│   │   │   └── Auth/            # Kimlik doğrulama
│   │   ├── Requests/            # Form validasyon sınıfları
│   │   └── Resources/           # API JsonResource çıktıları
│   ├── Models/                  # Eloquent modelleri
│   │   └── Concerns/            # Trait'ler (CompletionScore vb.)
│   ├── Policies/                # Yetkilendirme policy'leri
│   ├── Repositories/            # Veri erişim katmanı
│   ├── Services/                # İş mantığı katmanı
│   └── Support/                 # Yardımcı sınıflar
├── config/                      # Laravel konfigürasyonları
├── database/
│   ├── factories/               # Model factory'leri (test)
│   ├── migrations/              # Veritabanı migration'ları
│   └── seeders/                 # Veri tohumlamaları
├── docker/                      # Docker yapılandırma dosyaları
├── resources/
│   └── views/                   # Blade şablonları
│       ├── auth/                # Giriş ekranı
│       ├── bebek/               # Bebek izlem view'ları
│       ├── layouts/             # Ana layout (Glassmorphism)
│       └── lohusa/              # Lohusa izlem view'ları
├── routes/                      # Web & API route tanımları
├── tests/                       # Pest test süitleri
├── .github/                     # CI/CD workflow dosyaları
├── docker-compose.yml           # Docker Compose yapılandırması
├── Dockerfile                   # Render için container tanımı
├── render.yaml                  # Render platform yapılandırması
└── vite.config.js               # Vite frontend yapılandırması
```

<br/>

## 🤝 Katkıda Bulunma

1. Bu repository'yi fork edin
2. Feature branch oluşturun (`git checkout -b feature/yeni-ozellik`)
3. Değişikliklerinizi commit edin (`git commit -m 'feat: yeni özellik eklendi'`)
4. Branch'inizi push edin (`git push origin feature/yeni-ozellik`)
5. Pull Request açın

> Commit mesajlarında [Conventional Commits](https://www.conventionalcommits.org/) formatını kullanmanızı öneririz.

<br/>

## 📄 Lisans

Bu proje [MIT Lisansı](LICENSE) ile lisanslanmıştır.

<br/>

---

<div align="center">

**Geliştirici** · [Ferhat Ölmez](https://github.com/ferhatolmez)

*Katkılara açıktır · Yıldız atmayı unutmayın ⭐*

</div>
