# SmartVoyager Iroda Desktop Application

Egy Electron + React alapú asztali alkalmazás a SmartVoyager Iroda felhasználók számára.

## Funkciók

- ✅ **Bejelentkezés** Iroda/Admin fiókkal
- ✅ **Foglalások kezelése** (státusz módosítás, email küldés, törlés)
- ✅ **Úticélok kezelése** (CRUD műveletek)
- ✅ **Valós idejű adatszinkronizáció** a Laravel API-val
- ✅ **Modern UI** Material-Design alapokon
- ✅ **Magyar nyelvű felület**

## Telepítés és futtatás

### 1. Laravel API beállítása

```bash
# Navigálj a Laravel projekt mappájába
cd d:\BIZTONSÁG\2\fesu\Remek

# Telepítsd a szükséges csomagokat
composer install

# Futtasd a migrációkat
php artisan migrate

# Indítsd a szervert
php artisan serve
```

### 2. Desktop alkalmazás telepítése

```bash
# Navigálj a desktop app mappájába
cd iroda-desktop-app

# Telepítsd a Node.js csomagokat
npm install

# Fejlesztési módban való futtatáshoz
npm run electron-dev

# Build készítéséhez
npm run build
npm run electron-pack
```

## API végpontok

### Hitelesítés
- `POST /api/iroda/login` - Bejelentkezés
- `POST /api/iroda/logout` - Kijelentkezés
- `GET /api/iroda/me` - Felhasználói adatok

### Foglalások
- `GET /api/iroda/reservations` - Foglalások listázása
- `GET /api/iroda/reservations/{id}` - Foglalás részletei
- `PUT /api/iroda/reservations/{id}/details` - Részletek módosítása
- `PUT /api/iroda/reservations/{id}/status` - Státusz módosítása
- `POST /api/iroda/reservations/{id}/email` - Email küldése
- `DELETE /api/iroda/reservations/{id}` - Foglalás törlése

### Úticélok
- `GET /api/iroda/destinations` - Úticélok listázása
- `POST /api/iroda/destinations` - Új úticél létrehozása
- `GET /api/iroda/destinations/{id}` - Úticél részletei
- `PUT /api/iroda/destinations/{id}` - Úticél módosítása
- `DELETE /api/iroda/destinations/{id}` - Úticél törlése

## Használat

1. **Indítsd el a Laravel szervert**: `php artisan serve`
2. **Indítsd el a desktop alkalmazást**: `npm run electron-dev`
3. **Jelentkezz be** egy Iroda/Admin fiókkal:
   - Teszt Iroda fiók: `test@igazi.email`
   - Teszt Admin fiók: `admin@igazi.email`
4. **Kezeld a foglalásokat és úticélokat** a felületen keresztül

## Fejlesztés

### Projekt struktúra
```
iroda-desktop-app/
├── public/
│   ├── electron.js      # Electron fő folyamat
│   ├── preload.js       # Preload szkript
│   └── index.html       # HTML template
├── src/
│   ├── api.js           # API kliens
│   ├── App.js           # Fő React komponens
│   ├── index.js         - React belépési pont
│   └── components/
│       ├── Login.js     - Bejelentkezés
│       ├── Navbar.js    - Navigációs sáv
│       ├── Dashboard.js - Vezérlőpult
│       ├── Reservations.js - Foglalások
│       └── Destinations.js - Úticélok
└── package.json
```

### API konfiguráció
Az API base URL a `src/api.js` fájlban állítható:
```javascript
const API_BASE_URL = 'http://localhost:8000/api';
```

## Build és terjesztés

### Windows build
```bash
npm run build
npm run electron-pack
```

A buildelt alkalmazás a `dist/` mappában található.

## Hibaelhárítás

### Gyakori problémák

1. **CORS hiba**: Győződj meg róla, hogy a Laravel API fut a megfelelő porton
2. **Hitelesítési hiba**: Ellenőrizd, hogy a felhasználónak van-e Iroda vagy Admin jogosultsága
3. **API kapcsolat hiba**: Ellenőrizd, hogy a Laravel szerver elérhető-e

### Naplózás
- Electron: Fejlesztői eszközök megnyitása (Ctrl+Shift+I)
- Laravel: `storage/logs/laravel.log`

## Rendszerkövetelmények

- **Node.js** 16+
- **npm** 8+
- **Electron** 22+
- **React** 18+
- **Laravel** 12+
- **PHP** 8.2+

## Licenc

© 2026 SmartVoyager - Minden jog fenntartva
