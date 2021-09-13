<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Built with

* Laravel 8.16.1
* Bootstrap 5.1.0

## How to run

Before you start, you should install the dependencies using:
  ```sh
  npm install
  ```
Then run the migration:
  ```sh
  php artisan migrate
  ```
After that create an admin using tinker:
  ```sh
  php artisan tinker
  $admin = new App\Models\Admin();
  $admin->name = 'Your Name';
  $admin->username = 'your_username';
  $admin->email = 'email@exemple.com';
  $admin->password = Hash::make('your_password');
  $admin->save();
  ```
## That's it
The project is a prototype, so you can update it and costumize it as you want
