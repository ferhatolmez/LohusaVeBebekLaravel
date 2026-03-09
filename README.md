<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel">
  </a>
</p>

<p align="center">
  <strong>Lohusa ve Bebek İzlem Uygulaması</strong>
</p>

<p align="center">
  <em>Ebe ve sağlık profesyonelleri için çok adımlı formlar ve PDF rapor desteği sunan Laravel tabanlı sağlık takip uygulaması.</em>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/DomPDF-PDF-FF2D20?style=for-the-badge" alt="DomPDF">
  <img src="https://img.shields.io/badge/Vite-6-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Atatürk%20Üniversitesi-Sağlık%20Bilimleri%20Fakültesi%20Ebelik%20Bölümü-0f766e?style=flat-square" alt="Atatürk Üniversitesi">
</p>

---

## Proje Hakkında

**Atatürk Üniversitesi Sağlık Bilimleri Fakültesi Ebelik Bölümü** kapsamında geliştirilmiş bir **Lohusa ve Bebek İzlem Sistemi**dir. Lohusa (postpartum) ve yenidoğan bebek izlemlerini tek bir uygulamada toplar; çok adımlı formlar ve tek tıkla PDF rapor üretimi sunar.

- Klinik değerlendirmeleri standart formlarla toplama  
- Veriyi düzenli saklama ve gerektiğinde PDF olarak indirme  
- Laravel 12, PHP 8.2, Bootstrap 5 ile modern ve sade arayüz  

---

## Özellikler

| Modül | Açıklama |
|-------|----------|
| **Lohusa formu** | 16 adımlı form: tanıtıcı bilgiler, obstetrik öykü, aile/sosyal durum, konut ve hijyen, menstrüel geçmiş, postpartum durum, emzirme ve psikolojik değerlendirme, fizik muayene, ebe yorumu. JSON alanlarla esnek yapı. |
| **Bebek formu** | Doğum/muayene tarihleri, termin durumu, vital bulgular, sistem bazlı fizik muayene (deri, baş, göz, solunum, KVS, GIS vb.). |
| **PDF** | Lohusa ve bebek kayıtları için tek tıkla PDF (DomPDF, Türkçe karakter desteği). |
| **Liste ve arama** | Lohusa: ad soyad araması; Bebek: cinsiyet ve metin araması. Sayfa başına 15 kayıt (pagination). |
| **CRUD** | Lohusa: listele, oluştur, detay, PDF, sil. Bebek: listele, oluştur, düzenle, detay, PDF, sil. |
| **Ana sayfa** | Form seçimi ve son Lohusa/Bebek kayıtları. |

---

## Ekran Akışı

| URL | Açıklama |
|-----|----------|
| `/` | Ana sayfa – form seçimi, son kayıtlar |
| `/lohusa` | Lohusa listesi (arama, pagination, detay, PDF, sil) |
| `/lohusa/create` | 16 adımlı Lohusa formu |
| `/bebek` | Bebek listesi (arama, filtre, pagination, detay, düzenle, sil, PDF) |
| `/bebek/create` | Bebek formu |
| `/bebek/{id}/edit` | Bebek formu düzenleme |

---

## Teknolojiler

- **Backend:** Laravel 12, PHP 8.2  
- **Veritabanı:** MySQL / PostgreSQL / SQLite (Laravel ile uyumlu)  
- **PDF:** barryvdh/laravel-dompdf  
- **Frontend:** Bootstrap 5, Vite  
- **Test:** Pest  

---

## Kurulum

**Gereksinimler:** PHP 8.2+, Composer, Node.js, MySQL 5.7+ (veya PostgreSQL / SQLite).

```bash
git clone https://github.com/ferhatolmez/LohusaVeBebekLaravel.git
cd LohusaVeBebekLaravel

cp .env.example .env
# .env içinde DB_CONNECTION, DB_DATABASE, DB_USERNAME, DB_PASSWORD ayarla

composer install
php artisan key:generate
php artisan migrate

npm install
```

**Çalıştırma:**

```bash
composer run dev
# veya: php artisan serve  ve  npm run dev
```

---

## Testler

```bash
php artisan test
```

`LohusaFormTest` ve `BebekFormTest`: ana sayfa, form CRUD, doğrulama, PDF, silme.

---

## Canlıya Alma (Herkesin Denemesi İçin)

Projeyi internette yayınlamak için **DEPLOYMENT.md** dosyasındaki adımları izleyin.

- **Render.com:** Ücretsiz PostgreSQL ile deploy; `render.yaml` ve `Dockerfile` hazır.  
- **Veritabanı:** MySQL yerine PostgreSQL veya SQLite kullanılabilir; Laravel ikisini de destekler.

Özet: [render.com](https://render.com) → GitHub bağla → PostgreSQL oluştur → Web Service (Docker) → Environment değişkenleri (`APP_KEY`, `APP_URL`, `DB_CONNECTION`, `DB_URL`) → Deploy.

---

## Proje Yapısı (Özet)

```
app/Http/Controllers/
  LohusaFormController.php   # Lohusa: index, create, store, show, destroy, exportPdf, sonKayitlar
  BebekFormController.php    # Bebek: index, create, store, show, edit, update, destroy, exportPdf

app/Models/
  LohusaForm.php
  BebekForm.php

resources/views/
  layouts/app.blade.php
  welcome.blade.php
  lohusa/  (index, create, show, pdf, steps/)
  bebek/   (index, create, edit, show, pdf)
```

---

## Lisans

MIT.

---

<p align="center">
  <strong>Geliştiren:</strong> <a href="https://github.com/ferhatolmez">Ferhat ÖLMEZ</a>
</p>
