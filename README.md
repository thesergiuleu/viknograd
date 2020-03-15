##VIKNOGRAD
#####Requirements 
    php 7.3
----------

    cd viknograd
    create a new file in root directory .env 
    then copy .env.example into it and edit
    NOTE: You have to have an empty database created. 
    DB_DATABASE="name of the database you've created"
    DB_USERNAME="database username"
    DB_PASSWORD="database password"
    APP_URL="url of the admin and api server which you'll set up"
    save file and run next comands
        composer install
        php artisan key:generate
        php artisan migrate
        php artisan db:seed

