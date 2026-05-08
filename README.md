# 🌸 My Web – Hani
Personal Homepage menggunakan Bootstrap 5 + PHP + MySQL

---

## 📁 Struktur Folder

```
hani_web/
├── index.php               ← Router utama (buka di browser)
├── hani_web.sql            ← File database (import ke phpMyAdmin)
├── includes/
│   ├── database.php        ← Konfigurasi koneksi PDO
│   ├── header.php          ← Carousel Bootstrap (12 grid)
│   ├── menu.php            ← Navbar Bootstrap (12 grid)
│   ├── sidebar.php         ← Sidebar list group (3 grid)
│   └── footer.php          ← Footer alert Bootstrap (12 grid)
├── pages/
│   ├── home.php            ← Halaman home (Horizontal Card)
│   ├── about.php           ← Halaman about (Accordion)
│   ├── contact.php         ← Halaman contact (Card Groups)
│   ├── level.php           ← CRUD Level pendidikan
│   ├── studies.php         ← CRUD Riwayat pendidikan
│   └── login.php           ← Form login
└── assets/
    └── css/
        └── style.css       ← Tema pink kustom
```

---

## 🚀 Cara Install & Menjalankan

### Prasyarat
- XAMPP / WAMP / Laragon (PHP 8.x + MySQL)
- Browser modern

### Langkah-langkah

1. **Copy folder** `hani_web/` ke direktori web server:
   - XAMPP → `C:\xampp\htdocs\hani_web\`
   - Laragon → `C:\laragon\www\hani_web\`

2. **Import database:**
   - Buka `http://localhost/phpmyadmin`
   - Buat database baru bernama `hani_web`
   - Klik **Import** → pilih file `hani_web.sql` → klik **Go**

3. **Konfigurasi database** (jika password MySQL berbeda):
   - Buka `includes/database.php`
   - Ubah `DB_USER` dan `DB_PASS` sesuai MySQL Anda

4. **Jalankan:**
   - Buka browser → `http://localhost/hani_web/`

---

## 🔑 Login Demo

| Username | Password | Role  |
|----------|----------|-------|
| hani     | 1234     | Admin |
| admin    | 1234     | Admin |

---

## ✨ Fitur

- ✅ Carousel otomatis (header)
- ✅ Navbar responsif + dropdown My Studies
- ✅ Sidebar dengan list group
- ✅ **Home** – Horizontal Card profil Hani
- ✅ **About Me** – Accordion (Hobi, Favorite Menu, Organisasi, Skills)
- ✅ **Contact Me** – Card Groups sosial media
- ✅ **Level** – CRUD dengan tabel (TK, SD, SMP, SMA, S1, dst)
- ✅ **Studies** – CRUD riwayat pendidikan lengkap dengan foto
- ✅ Login wajib untuk akses CRUD
- ✅ Tampil nama + role user setelah login, ada submenu Logout
- ✅ Tema warna **Pink** yang cantik dan elegan 🌸
- ✅ Footer alert Bootstrap

---

Made with 💖 by Hani | Bootstrap 5 + PHP + MySQL
