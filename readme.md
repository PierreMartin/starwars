# E-StarWars

## Installation

clone

      https://github.com/PierreMartin/starwars.git

create .env file (or rename '.env.example' to '.env') and remplace by (you can change by your DB_DATABASE, DB_USERNAME...):

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

In database => table categories, change the two random title by 'Lasers' and 'Casques'


## Naviagtion :

      $ php artisan serve

      http://localhost:8000/

      Don't forget to run your server sql

To log as an administrator:

      - email    : pierre@gmail.com
      - password : 1111


To log as a customer and submit an order:

      the better is take a name with email of a client in table 'customers'


For to test maildev :

      $ maildev

      localhost:1080/#/

For test Akismet :
      try to send `viagra-test-123` in field `Votre message` from the contact `page`


For add new image from admin, I have prepared 10 images in `/public/assets/img`


For change css or js :

      $ grunt watch