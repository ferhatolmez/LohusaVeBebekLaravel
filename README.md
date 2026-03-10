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
**klinik akışına göre tasarlanmış modern, güvenli ve kapsamlı sağlık yönetim sistemi.**

<br/>

<a href="#-kurulum">Kurulum</a> ·
<a href="#-sistem-mimarisi-ve-backend-örüntüleri">Mimari</a> ·
<a href="#-api-kullanımı">API</a> ·
<a href="#-test--kalite">Testler</a>

<br/>

---

</div>

## 📋 İçindekiler

- [Proje Hakkında](#-proje-hakkında)
- [Öne Çıkan Özellikler](#-öne-çıkan-özellikler)
- [Sistem Mimarisi ve Backend Örüntüleri](#-sistem-mimarisi-ve-backend-örüntüleri)
- [Teknoloji Yığını](#-teknoloji-yığını)
- [Modüller](#-modüller)
- [Kurulum](#-kurulum)
- [Kullanıma Başlama](#-kullanıma-başlama)
- [API Kullanımı](#-api-kullanımı)
- [Test & Kalite](#-test--kalite)

<br/>

## 💡 Proje Hakkında

Doğum sonrası dönem, hem anne hem bebek için kritik bir süreçtir. Geleneksel kliniklerde bu süreç genellikle kağıt formlar veya basit e-tablolar ile yönetilmektedir.

**Lohusa & Bebek İzlem Platformu**, ebe ve klinisyenlerin bu hassas süreci **dijital, entegre, ölçülebilir ve son derece güvenli** bir biçimde yönetmesini sağlar. Sektör standartlarında Laravel mimarisi kullanılarak inşa edilmiş olan uygulama, sadece bir veri giriş aracı değil; riskleri öngören, hasta durumunu analiz eden ve kliniğe bütüncül bir bakış açısı sunan bir asistan görevi görür.

<br/>

## ✨ Öne Çıkan Özellikler

| Kategori | Özellik | Detay |
|:---|:---|:---|
| **Klinik Analiz** | Hasta Risk Skoru | Hayati bulgular (ateş, tansiyon) ve psikolojik faktörlere göre otomatik risk (Düşük/Orta/Yüksek) hesaplama |
| **İş Akışı** | Çok Adımlı Form Sihirbazı | 16 adımlık parçalı kayıt akışı (klinik → fiziksel muayene → sosyal durumlar) |
| **Görselleştirme**| Dinamik Dashboard | Chart.js destekli aylık kayıt trendi, termin ve beslenme dağılımları, hızlı özet metrikler |
| **Yönetim** | Admin ve Kullanıcı Paneli| Yöneticiler için takım yönetimi (Ebe, Öğrenci), rol atama, profil ve şifre güncellemeleri |
| **UX & UI** | Dark Mode & Kısayollar | Göz yormayan yerel depolamalı Karanlık Tema, güç-kullanıcıları için klavye kısayolları (`N`, `B`, `?`) |
| **Güvenlik** | Role-Based Access Control| Spatie Permission altyapısı ile `admin`, `ebe` ve `student` rolleriyle form okuma/yazma kısıtlamaları |
| **Dışa Aktarım**| CSV ve PDF Çıktı | Formların detaylı PDF'ini oluşturma (DomPDF) veya toplu listeleri CSV formatında indirebilme |
| **Altyapı** | İleri Backend Patternleri| Observer, Event/Listener, Type-Safe Enums, Soft Deletes, Rate Limiting gibi sektör pratikleri |

<br/>

## 🔧 Sistem Mimarisi ve Backend Örüntüleri

Bu proje, ölçeklenebilir ve test edilebilir modern bir Laravel uygulamasının nasıl tasarlanması gerektiğini göstermek üzere en güncel yazılım örüntüleri (Software Patterns) ile kodlanmıştır:

- **Repository & Service Pattern:** İş mantığı (`Service`) ve veri tabanı erişimi (`Repository`) Controller'lardan tamamen ayrıştırılarak `SOLID` prensiplerine uygun mimari sağlanmıştır.
- **Observer Pattern:** Modeller üzerindeki (Lohusa, Bebek) oluşturma, güncelleme ve silme eylemleri `ActivityLog` modeli vasıtasıyla eşzamanlı olarak veritabanına loglanır.
- **Event-Driven Architecture (Event/Listener):** `FormCreated` olayı fırlatılarak sisteme eklenen yeni formların loglama işlemleri loosely coupled (gevşek bağlı) şekilde `LogFormCreation` dinleyicisi ile gerçekleşir.
- **Type-Safe Enums (PHP 8.1+):** Rol yönetimi ve takip durumları, hatalı veri girişini önlemek ve state mantığını düzenlemek için `App\Enums` altında (renk, ikon metotları dahil) yapılandırılmıştır.
- **Soft Deletes:** Klinik hasta verilerinin kalıcı olarak yok edilmesini engellemek için `deleted_at` mekanizması devreye alınmıştır.
- **API Rate Limiting:** Servislere yönelik brute force saldırılarını önlemek adına `AppServiceProvider` üzerinden yapılandırılan dakikada 60 istekle sınırlı bir `throttle` tanımlanmıştır.
- **Health Check Endpoint (`/api/health`):** Sunucu ve DB durumunu izleyen (Monitoring) üretim ortamlarına hazır sağlık test noktası oluşturulmuştur.
- **Artisan Console Commands:** Sistem yöneticilerinin takip durumlarını görebilmesi için `php artisan report:daily` terminal komutu entegre edilmiştir.

```text
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
```

<br/>

## 🛠 Teknoloji Yığını

| Katman | Teknoloji |
|:---|:---|
| **Backend** | PHP 8.2 + Laravel 12 |
| **API Güvenliği** | Laravel Sanctum |
| **Yetkilendirme** | Spatie Laravel Permission |
| **PDF & Raporlama**| Barryvdh DomPDF, League CSV |
| **Test** | Pest Framework (Feature, Unit) |
| **Frontend** | Blade, Bootstrap 5, Chart.js, Lucide Icons |
| **Tema Özellikleri**| Glassmorphism, Native Dark Mode, Custom CSS Variables |
| **Veritabanı** | MySQL / SQLite |

<br/>

## 📦 Modüller

<details>
<summary><strong>📊 Dashboard & Analitik</strong></summary>
<br/>
- Aktif ve toplam form sayılarının üst seviye özeti.<br/>
- <strong>Chart.js Entegrasyonu:</strong> 6 aylık kayıt trend çubukları, yenidoğan bebek termin (zamanında/erken) dağılım pasta grafiği ve beslenme istatistiği.<br/>
- Bugün ve bu hafta için aciliyet rengine göre sınıflandırılmış <strong>Takip Uyarıları</strong>.
</details>

<details>
<summary><strong>🤱 Lohusa İzlem Modülü</strong></summary>
<br/>
- Çok adımlı form üzerinden anneye ait fizyolojik bulguların girilmesi.<br/>
- `RiskCalculator` sınıfı ile annenin ateşi, tansiyonu veya psikolojik durumuna dayanarak "Düşük/Orta/Yüksek" risk seviyelerinin otomatik saptanması.<br/>
- Tarayıcı kapanmasına kalsı veri kaybını önleyen "Taslak Kaydetme" (LocalStorage).<br/>
- PDF Rapor ve Excel/CSV indirme.
</details>

<details>
<summary><strong>👶 Bebek İzlem Modülü</strong></summary>
<br/>
- Genişletilmiş muayene adımları (cilt, baş, göbek kordonu vs.)<br/>
- Yenidoğanın doğum yeri, termin durumu ve beslenme modeline yönelik takibi.<br/>
- Düzenleme (Update) desteği.<br/>
- CSV olarak dışarı aktarım seçenekleri.
</details>

<details>
<summary><strong>👥 Kullanıcı & Profil Yönetimi</strong></summary>
<br/>
- <strong>Profilim:</strong> Her kullanıcının e-postasını ve şifresini güvenle güncelleyebileceği sayfa.<br/>
- <strong>Admin Paneli:</strong> Sistem yetkililerinin hesapları izlediği, yeni ebe veya öğrenci hesapları yaratıp silebildiği `UserController` tabanlı yönetim alanı.
</details>

<br/>

## 🚀 Kurulum

### Ön Koşullar

- PHP ≥ 8.2 (`pdo_sqlite` uzantısı testler için gerekli)
- Composer
- Node.js ≥ 18 + npm
- MySQL veya SQLite bağlantısı

### Adım Adım Kurulum

```bash
# 1. Projeyi klonlayın
git clone https://github.com/ferhatolmez/LohusaVeBebekLaravel.git
cd LohusaVeBebekLaravel

# 2. Bağımlılıkları yükleyin
composer install
npm install
npm run build

# 3. Çevre değişkenlerini ayarlayın
cp .env.example .env
php artisan key:generate

# 4. Veritabanını yapılandırın (SQLite varsayılan yapılabilir veya MySQL bilgilerinizi .env'ye girin)
php artisan migrate:fresh --seed

# 5. Sunucuyu başlatın
php artisan serve
```

## 👩‍⚕️ Kullanıma Başlama

Sunucu çalışırken varsayılan admin hesabıyla panele girebilirsiniz (migration'da seed edilmişse). Aksi takdirde, Laravel Tinker üzerinden ilk ana kullanıcı hesabınızı şu şekilde oluşturabilirsiniz:

```bash
php artisan tinker
```
```php
$user = App\Models\User::create(['name' => 'Sistem Yöneticisi', 'email' => 'admin@clinic.com', 'password' => bcrypt('password123')]);
$user->assignRole('admin');
```

Bu bilgilerle giriş yaptıktan sonra:
1. Sağ üst menüden **Kullanıcı Yönetimi**'ne gidip kliniğinizdeki diğer kişileri (*Ebe*, *Öğrenci*) oluşturun.
2. Ana ekrandan veya klavyeden `N` tuşuna basarak ilk Lohusa kaydını yaratın.

<br/>

## 🔌 API Kullanımı

Sistemin sunduğu RESTful JSON API altyapısı mevcuttur. İstek yapmak için token gereklidir.

1. **Token Alma:** `POST /api/v1/tokens/create` (email ve password ile)
2. **Kayıt Listeleme:** `GET /api/v1/lohusa?page=1` (Header: `Authorization: Bearer <token>`)
3. **Sistem Durumu:** `GET /api/health`

Tüm API yanıtları `JsonResource` üzerinden düzenli formatta (data/meta) dönmektedir ve Rate Limiting ile limitlenmiştir.

<br/>

## 🧪 Test & Kalite

Proje, iş mantığının hiç kırılmadığından emin olmak için **Pest PHP** framework'ü kullanılarak yazılmış kapsamlı test paketlerine sahiptir.

```bash
# Tüm test senaryolarını çalıştırmak için
php artisan test
```

Testler in-memory SQLite kullanarak çalışır (Test sırasında veritabanına zarar gelmez):
- `LohusaFormTest` — Erişilebilirlik, yaratma ve PDF indirme işlemleri
- `BebekFormTest` — Validasyonlar, düzenleme ve listeleme testleri
- `DashboardTest` — Rollerin doğru veriyi görüp görmediği

---

<div align="center">
  <p>Lohusa & Bebek İzlem Platformu · 2026</p>
</div>
