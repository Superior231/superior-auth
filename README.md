# Superior Auth

**Superior Auth** adalah sistem registrasi penggua berbasis web yang memungkinkan pengguna untuk mendaftar, masuk, dan logout. Superior Auth memiliki dua metode autentikasi, yaitu melalui registrasi konvensional (menggunakan email dan password) dan autentikasi  menggunakan akun Google. Fitur ini dirancang untuk memberikan pengalaman pengguna yang lebih mudah dan fleksibel dalam proses autentikasi.

Fitur utama Superior Auth:
1. Autentikasi standar (menggunakan email dan password).
2. Autentikasi menggunakan akun Google.
3. Logout
4. Validasi data
Validasi data pada saat login dan register seperti email atau password salah, email sudah digunakan, password tidak cocok, username terlalu panjang, dan pengecekan status user (approved atau banned). Jika user memiliki status banned maka user tidak bisa login.
5. Personalisasi profil
Pengguna dapat memperbarui informasi pribadi, termasuk mengganti avatar.
6. Dashboard Admin
Admin dapat mengelola akun pengguna seperti ubah avatar, username, email, password, dan banned user.
7. Keamanan Login dan Middleware:
Sistem dilengkapi dengan teknologi keamanan password hashing yang canggih, sehingga setiap data sensitif yang dimasukkan oleh pengguna terlindungi dengan baik. Selain itu, penggunaan middleware memastikan bahwa akses ke setiap halaman dalam aplikasi terbatas sesuai dengan peran dan hak akses pengguna. Dengan langkah-langkah keamanan ini, Superior Auth menjaga kerahasiaan data dan melindungi sistem dari potensi ancaman.

## Requirements

- [Laravel 11](https://laravel.com/docs/11.x)
- [Composer](https://getcomposer.org/)
- [PHP 8.3](https://www.php.net/)
- [XAMPP](https://www.apachefriends.org/download.html)

## Libraries

- [Laravel UI](https://github.com/laravel/ui)
- [Laravel Socialite](https://laravel.com/docs/11.x/socialite)
- [SweetAlert2](https://sweetalert2.github.io/)
- [Bootstrap](https://getbootstrap.com/)
- [DataTables](https://datatables.net/)

## API

- [Google OAuth 2.0](https://developers.google.com/identity/protocols/oauth2)

## Installation

Clone the repository by running the following command:

```shell
git clone https://github.com/Superior231/superior-auth.git
cd superior-auth
```

Install Dependency:

```shell
composer install
```

Set Environment Variables:

```shell
cp .env.example .env
```

Generate Application Key:

```shell
php artisan key:generate
```

Database Configuration `.env`:

```shell
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=superior_auth
DB_USERNAME=root
DB_PASSWORD=
```

```shell
php artisan migrate
```

### How to use Google OAuth with Laravel Socialite?

Anda dapat mengunjungi artikel ini untuk mengetahui bagaimana cara menggunakan Google OAuth di Laravel Socialite
[Cara Membuat Login with Google Menggunakan Laravel Socialite di Laravel 11](https://blog.hikmal-falah.com/detail/cara-membuat-login-with-google-menggunakan-laravel-socialite-di-laravel-11)

## Usage

Run Application:

```shell
php artisan serve
```

Server is running. Open url `http://127.0.0.1:8000` in browser.