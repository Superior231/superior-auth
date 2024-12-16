# Superior Auth

**Superior Auth** is a web-based user registration system that allows users to register, login, and logout. Superior Auth has two authentication methods, namely conventional registration (using email and password) and authentication using a Google account. This feature is designed to provide a more convenient and flexible user experience in the authentication process.

The main features of Superior Auth are:
1. Standard authentication (using email and password).
2. Authentication using a Google account.
3. Logout
4. Data validation
Data validation during login and registration such as incorrect email or password, email already in use, mismatched password, username too long, and user status checking (approved or banned). If a user has a banned status, they cannot login.
5. Profile personalization
Users can update their personal information, including changing their avatar.
6. Admin dashboard
Admins can manage user accounts, including changing avatars, usernames, emails, passwords, and banning users.
7. Login security and middleware:
The system is equipped with advanced password hashing technology, which protects sensitive data entered by users. Additionally, the use of middleware ensures that access to each page in the application is limited according to the user's role and access rights. With these security measures, Superior Auth maintains data confidentiality and protects the system from potential threats.

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
php artisan migrate --seed
```

### How to use Google OAuth with Laravel Socialite?

You can visit this article to learn how to use Google OAuth with Laravel Socialite
[Cara Membuat Login with Google Menggunakan Laravel Socialite di Laravel 11](https://blog.hikmal-falah.com/detail/cara-membuat-login-with-google-menggunakan-laravel-socialite-di-laravel-11)

## Usage

Run Application:

```shell
php artisan serve
```

Server is running. Open url `http://127.0.0.1:8000` in browser.