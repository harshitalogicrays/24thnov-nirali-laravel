how to run the code -
1. open terminal from your project location
2. cp .env.example .env 
3. open .env file and update database and mail configuration
4. run -  composer install
5. run - php artisan key:generate
6. run - php artisan migrate:fresh --seed
7. run - php artisan serve 