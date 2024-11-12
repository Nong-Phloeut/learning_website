## setup 
copy .env.example to .env
## setup database  
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

## step 1
composer i or composer install 
php artisan key:generate
php artisan jwt:secret
## step 2
php artisan migrate
## any change in migration
php artisan migrate:rollback
php artisan migrate:fresh
## step 3
php artisan db:seed

## Run server 
php artisan serve

