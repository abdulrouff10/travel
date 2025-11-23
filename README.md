# **Travel App – Sistem Pemesanan Tiket Travel**

Aplikasi pemesanan tiket travel berbasis **Laravel 12** dengan dua role utama: **Admin** dan **Penumpang**.
Mendukung pengelolaan jadwal travel, pemesanan tiket, pembayaran, hingga laporan.

---

## ✨ **Fitur Utama**

### 👥 **Guest**

* Landing page informasi travel
* Registrasi & login penumpang

### 🧳 **Penumpang**

* Dashboard penumpang
* Lihat jadwal travel tersedia
* Pemesanan tiket + validasi kuota
* Riwayat pemesanan
* Upload bukti pembayaran
* Cetak invoice

### 🧑‍💼 **Admin**

* Dashboard admin
* CRUD Jadwal Travel
* Laporan penumpang per jadwal
* Manajemen data penumpang

---

## 🛠 **Teknologi**

* **Backend:** Laravel 12, Eloquent ORM
* **Frontend:** Blade, Bootstrap 4, AdminLTE 3
* **Database:** MySQL
* **Authentication:** Laravel UI

---

## 🧑‍💻 **Instalasi & Setup**

### **1. Clone Repository**

```bash
git clone https://github.com/abdulrouff10/travel.git
cd travel
```

### **2. Install Dependency**

```bash
composer install
```

### **3. Konfigurasi Environment**

```bash
cp .env.example .env
php artisan key:generate
```

### **4. Setting Database**

Edit file `.env`:

```
DB_DATABASE=travel
DB_USERNAME=root
DB_PASSWORD=
```

### **5. Migrasi & Seeder**

```bash
php artisan migrate --seed
```

### **6. Jalankan Server**

```bash
php artisan serve
```

---

## 🔑 **Akun Default (Seeder)**

| Role  | Email                                     | Password |
| ----- | ----------------------------------------- | -------- |
| Admin | [admin@gmail.com](mailto:admin@gmail.com) | admin123 |

---

## 📖 **Cara Penggunaan**

### **Penumpang**

1. Registrasi & login
2. Lihat jadwal → pesan tiket
3. Upload bukti pembayaran
4. Cetak invoice

### **Admin**

1. Login sebagai admin
2. Kelola jadwal (CRUD)
3. Lihat laporan
4. Kelola data penumpang

---
