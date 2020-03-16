##VIKNOGRAD
#####Requirements 
    php 7.3
----------

    cd viknograd
    Open .env file and edit nex fields
    NOTE: You have to have an empty database created. 
    DB_DATABASE="name of the database you've created"
    DB_USERNAME="database username"
    DB_PASSWORD="database password"
    APP_URL="url of the admin and api server which you'll set up"
    save file and run next comands
        sudo chmod -R 777 bootstrap
        sudo chmod -R 777 storage
        php artisan migrate
        php artisan db:seed
        php artisan storage:link
        
    to import a user run 
        php artisan import:user 
    and follow instructions
        
