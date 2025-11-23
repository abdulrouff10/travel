🚌 Travel App – Sistem Pemesanan Tiket Travel

Aplikasi pemesanan tiket travel berbasis Laravel 10 dengan dua role utama: Admin dan Penumpang. Mendukung pengelolaan jadwal travel, pemesanan tiket, pembayaran, hingga laporan.

✨ Fitur Utama
👥 Guest

Landing page informasi travel

Registrasi & login penumpang

🧳 Penumpang

Dashboard penumpang

Lihat jadwal travel tersedia

Pemesanan tiket + validasi kouta

Riwayat pemesanan

Upload bukti pembayaran

Cetak invoice

🧑‍💼 Admin

Dashboard admin

CRUD Jadwal Travel

Laporan penumpang per jadwal

Manajemen data penumpang

🛠 Teknologi

Backend: Laravel 12, Eloquent ORM

Frontend: Blade, Bootstrap 4, AdminLTE 3

Database: MySQL

Auth: Laravel UI

🧑‍💻 Instalasi & Setup
Clone Repositori
git clone https://github.com/abdulrouff10/travel.git
cd travel

Install Dependency
composer install

Konfigurasi Environment
cp .env.example .env
php artisan key:generate

Setting Database
DB_DATABASE=travel
DB_USERNAME=root
DB_PASSWORD=

jalankan Data Seeder
php artisan migrate --seed

Jalankan Server
php artisan serve

🔑 Akun Default (Seeder)

Admin
Email: admin@gmail.com
Password: admin123

Database (Opsional)
jika ingin import database
travel.sql

📖 Cara Penggunaan
Penumpang

Registrasi & login

Lihat jadwal → pesan tiket

Upload bukti pembayaran

Cetak invoice

Admin

Login sebagai admin

Kelola jadwal (CRUD)

Lihat laporan

Kelola data penumpang