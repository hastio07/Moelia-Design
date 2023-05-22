
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
<p align="center"> <a href="https://github.com/hastio07/Moelia-Design" target="_blank"> <img src="https://raw.githubusercontent.com/hastio07/Moelia-Design/master/public/img/logoMulia.jpg"
height="auto" width="200" alt="Moelia Design Logo"></a></p>

## Perihal Moelia Design
Moelia Design Project adalah sebuah proyek aplikasi berbasis website. Proyek ini dibangun dengan menggunakan bahasa pemrograman PHP serta framework Laravel sebagai teknologi pendukungnya. Aplikasi ini hadir untuk mempermudah pengguna dalam mencari penyedia jasa wedding organizer yang sesuai dengan kebutuhan mereka.

## Cara Instalasi
### Development Mode
Untuk dapat menjalankan proyek ini di lokal, lakukan beberapa langkah berikut:

1. Clone repository ke komputer lokal dengan menggunakan perintah berikut:
```git
git clone https://github.com/hastio07/Moelia-Design.git [nama_folder]
```
2. Masuk ke direktori proyek dengan perintah:
```bash
cd [nama_folder]
```
3. Jalankan perintah berikut untuk menginstall semua dependecies:
```php
composer install
```
4. Salin file `.env.example` ke file baru bernama `.env`:
```bash
cp .env.example .env
```
5. Generate app key dengan perintah:
```php
php artisan key:generate
```
6. Konfigurasi database pada file `.env` dengan mengisi nilai `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` dengan nilai yang sesuai.
```
DB_HOST=host_database
DB_PORT=port_database
DB_DATABASE=nama_database
DB_USERNANAME=username_database
DB_PASSWORD=password_database
```
8. Jalankan perintah berikut untuk menjalankan migrasi dan seeding:
```php
php artisan migrate --seed
```
9. Jalankan server lokal dengan perintah:
```php
php artisan serve
```

## Contributors

<a href="https://github.com/hastio07/Moelia-Design/graphs/contributors">
  <img src="https://contributors-img.web.app/image?repo=hastio07/Moelia-Design" />
</a>