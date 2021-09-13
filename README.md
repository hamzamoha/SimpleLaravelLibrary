<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></p>

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

## Any suggestion
If you face any error or vulnerability, email me at: <a href="mailto:hamzamoha123@gmail.com">hamzamoha123@gmail.com</a>
