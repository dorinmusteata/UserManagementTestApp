# UserManagementTestApp
A Full-Stack Web Application, which was created after receiving a test from a company.

## Quick Installation

git clone https://github.com/dorinmusteata/UserManagementTestApp app

### Features

* User groups & permissions system
* apiDoc
* PHP 7.1.*
* REST API with JWT Auth

### Backend (Laravel 5.7)

* Create .env from .env.example file and set the database connection credentials

1. *cd app , cd back_app*
2. *composer install*
3. *php artisan migrate*
4. *php artisan db:seed*
5. *php artisan key:generate*
6. *php artisan jwt:secret*
7. *php artisan serve*
8. *http://localhost:8000/api/ - API ENDPOINT BASE*
9. *http://localhost:8000/apidoc/ - APIDOC*

** Default user: tester@mail.com|tester

### Frontend (Vue.js + Vuex)

1. *cd front_app*
2. *npm install*
3. *npm run serve*
4. *http://localhost:8080/#/*
