##TOOLBAR

    git clone git@gitlab.com:stephone95/toolbar.git
    cd toolbar
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
    php artisan passport:install
    php artisan db:seed

