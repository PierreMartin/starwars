## E-Star-Wars

clone 'https://github.com/PierreMartin/starwars.git'

create .env file (rename '.env.example' to '.env')

In .env, remplace by:

      APP_ENV=local
      APP_DEBUG=true
      APP_KEY=09JvBkBxjUxSCpgBHoIx7C0FkUwRVvKh

      DB_HOST=localhost
      DB_DATABASE=starwars2
      DB_USERNAME=pierre
      DB_PASSWORD=pierre

      CACHE_DRIVER=file
      SESSION_DRIVER=file
      QUEUE_DRIVER=sync

      MAIL_DRIVER=smtp
      MAIL_HOST=127.0.0.1
      MAIL_PORT=1025
      MAIL_USERNAME=null
      MAIL_PASSWORD=null
      MAIL_ENCRYPTION=false
      MAIL_ACCESS=youremail@gmail.com
      MAIL_NAM=pierre

      KEY_AKISMET=8edaaafa2377
      URL_AKISMET=http://localhost:8000

Run commande line :

    $ sudo chmod +x install.sh
    $ ./install.sh
    $ sh install.sh

In database => table categories, change the two random title by 'Lasers' and 'Casques'

Run

      php artisan serve