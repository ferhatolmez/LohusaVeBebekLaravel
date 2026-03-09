# Projeyi Herkese Açık Yayınlama Rehberi

Bu rehber, Lohusa ve Bebek İzlem uygulamasını **internette canlı** yayınlayarak herkesin deneyebilmesi için adım adım talimatlar içerir.

---

## Hızlı Başlangıç (Render + PostgreSQL)

1. [render.com](https://render.com) → GitHub ile giriş → `LohusaVeBebekLaravel` reposuna erişim verin  
2. **New +** → **Blueprint** → GitHub’da bu repoyu seçin, `render.yaml` otomatik okunur  
3. Veya manuel: **New +** → **PostgreSQL** (ad: `lohusa-db`) → **Web Service** (Docker, bu repo)  
4. Web Service’e **Environment** ekleyin:  
   - `APP_KEY` → Lokal `php artisan key:generate --show` çıktısı  
   - `APP_URL` → Deploy sonrası Render URL’i  
   - `DB_CONNECTION=pgsql`  
   - `DB_URL` → PostgreSQL “Internal URL” (Render otomatik bağlayabilir)  
5. Deploy tamamlanınca siteniz canlı olur.

---

## Özet: Hangi Yöntem?

| Yöntem | Zorluk | Maliyet | Veritabanı | Öneri |
|--------|--------|---------|------------|-------|
| **Render + SQLite** | Kolay | Ücretsiz | SQLite (dosya) | Başlangıç için ideal |
| **Render + PostgreSQL** | Orta | Ücretsiz | PostgreSQL | Veri kalıcı, daha profesyonel |
| **Railway** | Kolay | Ücretsiz kredi | PostgreSQL | Alternatif |

**MySQL** sunucu kurulumu gerektirdiği için ücretsiz PaaS’larda genelde yok. **SQLite** veya **PostgreSQL** kullanmanız önerilir; Laravel ikisini de destekler.

---

## Yöntem 1: Render + SQLite (En Kolay)

SQLite tek bir dosyada çalışır, harici veritabanı sunucusu gerekmez. Render’da **ephemeral** disk kullanırsınız; uygulama yeniden deploy edildiğinde veriler silinir. Demo/portföy için idealdir.

### Adım 1: Render Hesabı
1. [render.com](https://render.com) adresine gidin
2. “Get Started” → GitHub ile giriş yapın
3. GitHub’dan `LohusaVeBebekLaravel` reposuna erişim verin

### Adım 2: Web Service Oluşturma
1. Dashboard → **New +** → **Web Service**
2. Repository olarak `ferhatolmez/LohusaVeBebekLaravel` seçin
3. Ayarlar:
   - **Name:** `lohusa-bebek-izlem`
   - **Region:** Frankfurt (Avrupa)
   - **Branch:** `master`
   - **Runtime:** `Docker` (Dockerfile kullanılacak)
   - **Instance Type:** Free

### Adım 3: Environment Variables
“Environment” sekmesinde şunları ekleyin:

```
APP_NAME="Lohusa ve Bebek İzlem"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:XXXXXXX
APP_URL=https://lohusa-bebek-izlem.onrender.com
DB_CONNECTION=sqlite
DB_DATABASE=/opt/render/project/src/database/database.sqlite
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

**APP_KEY** oluşturmak için lokal projede:
```bash
php artisan key:generate --show
```
Çıkan değeri `APP_KEY=` satırına yapıştırın.

**APP_URL** değerini deploy sonrası Render’ın verdiği URL ile güncelleyin.

### Adım 4: SQLite Dockerfile Düzenlemesi
Projede `Dockerfile.sqlite` oluşturun veya mevcut Dockerfile’ı SQLite kullanacak şekilde güncelleyin. Ayrıca `database/database.sqlite` dosyasının oluşturulması gerekiyor. Render build sırasında `touch database/database.sqlite` çalıştırılmalı.

Bu senaryoda Dockerfile’da `php artisan migrate` öncesi:
```
touch database/database.sqlite
```
eklenmeli.

### Adım 5: Deploy
1. **Create Web Service** tıklayın
2. İlk build 5–10 dakika sürebilir
3. Build bitince `https://lohusa-bebek-izlem.onrender.com` adresinden erişin

---

## Yöntem 2: Render + PostgreSQL (Veri Kalıcı)

PostgreSQL ile veriler deploy’lar arasında kalır.

### Adım 1–2: Render hesabı ve repo bağlama (yukarıdaki gibi)

### Adım 3: PostgreSQL Veritabanı
1. Dashboard → **New +** → **PostgreSQL**
2. **Name:** `lohusa-db`
3. **Region:** Web service ile aynı (örn. Frankfurt)
4. **Create Database**
5. “Connect” kısmından **Internal Database URL** kopyalayın (örn. `postgresql://user:pass@host/dbname`)

### Adım 4: Web Service (Docker)
1. **New +** → **Web Service**
2. Repo: `LohusaVeBebekLaravel`
3. **Environment** değişkenleri:

```
APP_NAME="Lohusa ve Bebek İzlem"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:XXXXX
APP_URL=https://SIZIN-URL.onrender.com
DB_CONNECTION=pgsql
DATABASE_URL=postgresql://user:pass@host/dbname
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=sync
```

**Not:** Render `DB_URL` veya `DATABASE_URL` olarak connection string verir. Laravel bunu otomatik parse eder.

### Adım 5: Migration
Render’da ilk deploy sonrası “Shell” sekmesinden (varsa) veya “Manual Deploy” ile birlikte build komutlarına ekleyerek:

```bash
php artisan migrate --force
```

Build komutlarına eklemek için Render → Service → **Settings** → **Build Command**:
```
composer install --no-dev && php artisan migrate --force
```

### Adım 6: Dockerfile
Mevcut Dockerfile MySQL varsayıyor olabilir. PostgreSQL için sadece PHP `pdo_pgsql` extension’ının kurulu olması yeterlidir. Laravel Docker imajlarının çoğunda zaten vardır.

---

## Yöntem 3: Railway (Alternatif)

1. [railway.app](https://railway.app) → GitHub ile giriş
2. **New Project** → **Deploy from GitHub**
3. `LohusaVeBebekLaravel` seçin
4. **Add PostgreSQL** (database ekleyin)
5. Environment: `DB_CONNECTION=pgsql`, `DATABASE_URL` Railway otomatik ekler
6. Deploy

---

## Veritabanı Karşılaştırması

| Veritabanı | Artı | Eksi |
|------------|------|------|
| **SQLite** | Kurulum yok, tek dosya, hızlı | Render’da veri kalıcı değil; disk ephemeral |
| **PostgreSQL** | Render/Railway ücretsiz, veri kalıcı | Biraz daha fazla kurulum |
| **MySQL** | Tanıdık | Ücretsiz PaaS’larda nadir; genelde VPS gerekir |

**Öneri:** Demo/portföy için **Render + PostgreSQL** en mantıklı seçenek.

---

## Özet Checklist

- [ ] GitHub’da repo public
- [ ] Render (veya Railway) hesabı
- [ ] PostgreSQL database oluşturuldu
- [ ] Web Service oluşturuldu
- [ ] `APP_KEY`, `APP_URL`, `DATABASE_URL` (veya `DB_*`) ayarlandı
- [ ] `php artisan migrate --force` çalıştırıldı
- [ ] Canlı URL test edildi

---

## Sorun Giderme

**500 Hatası:** `.env` eksik veya `APP_KEY` yanlış. Environment değişkenlerini kontrol edin.

**Veritabanı bağlantı hatası:** `DATABASE_URL` veya `DB_*` değerlerini kontrol edin. Internal URL kullanın (external değil).

**Sayfa boş / CSS yok:** `php artisan config:clear` ve `php artisan cache:clear` çalıştırın. Asset’ler `public` klasöründe mi kontrol edin.

**Migration hatası:** PostgreSQL’de enum kullanımı farklı olabilir. Gerekirse `database/migrations` içindeki `enum` alanlarını `string` olarak değiştirin.
