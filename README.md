# Tasks app.

The Project is built using laravel and it is used to manage several tasks by a specific created project

Projects requirements:
  - php >=8.2 
  - composer

Steps to run the project.
=========================

after cloning the project run:
1. composer install
2. cp .env.example .env (create new local DB named coalition_tasks_app and provide DB info in .env file)
3. php artisan key:generate
4. php artisan migrate
5. npm install
6. php artisan serve
7. npm run dev

The Project is ready
