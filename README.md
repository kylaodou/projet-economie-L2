# Journal comptable — projet d'économie (L2)

Application web de tenue d'un journal comptable, réalisée en Licence 2. On y saisit les
mouvements (date, libellé, montant, compte) et on obtient le journal et un rapport, exportables
en Excel et en PDF.

## Fonctionnalités

- Saisie d'un mouvement comptable.
- Liste des mouvements.
- Journal comptable.
- Rapport de synthèse.
- Export du journal en Excel et en PDF.

## Stack technique

- PHP 8.2+, Laravel 12
- MySQL
- maatwebsite/excel, barryvdh/laravel-dompdf
- Bootstrap, Font Awesome

## Installation

Prérequis : PHP 8.2+, Composer 2, MySQL.

```bash
git clone https://github.com/kylaodou/projet-economie-L2.git
cd projet-economie-L2

composer install
cp .env.example .env
php artisan key:generate
```

Renseignez la base MySQL dans `.env`, puis :

```bash
php artisan migrate
php artisan serve
```

L'application est disponible sur http://localhost:8000.

## Auteur

[@kylaodou](https://github.com/kylaodou)
