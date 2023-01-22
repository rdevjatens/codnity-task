Requirements
* php7.4^
* composer
* node 14^
* python3

1. composer install
2. php artisan key:generate
3. Change database credentials in .env file
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
3. php artisan migrate
4. php artisan serve
5. npm install
6. npm run dev
7. Access website at localhost:8000
8. To log in use credentials - username: username, password: password and press submit
9. To scrape data - python3 web-scraper/web-scraper.py
10. To delete item press on the row you want to delete and press delete
