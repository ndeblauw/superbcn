<p align="center"><a href="https://bluepundit.eu" target="_blank"><img src="https://bluepundit.eu/img/bluepundit-logo-pundit.png?1" width="100"></a></p>

# superbcn project
Example project for the BCN MWA 1 class of 2024-25

## Authors
- [bluePundit](https://bluepundit.eu) - Nico Deblauwe ([@ndeblauw](https://www.github.com/ndeblauw))

## Requirements
This project uses
- [Laravel 11](https://laravel.com/docs/11.x/releases)

## Environment Variables
Nothing but the normal ones

## Dev Installation instructions
- Create a directory for the project and cd into it
- Clone the project into this directory (`git clone https://github.com/ndeblauw/superbcn.git  .`)
- run `composer install`
- Create a .env for your dev environment: `cp .env.example .env` and adjust the settings (local domain, database, etc)
- Set the encryption key in the .env: `php artisan key:generate`
- if using sqlite: do execute `touch database/database.sqlite`
- and then migrate the tables: `php artisan migrate`
- and then seed date: `php artisan db:seed`.
