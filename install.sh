#!/usr/bin/env bash

echo "install Starwars Project (By Pierre MARTIN)"

composer self-update
composer install
php artisan vendor:publish

USERNAME='root'
PASSWORD='root'
DBNAME='starwars2'
HOST='localhost'

USER_USERNAME='pierre'
USER_PASSWORD='pierre'

MySQL=$(cat <<EOF
DROP DATABASE IF EXISTS $DBNAME;
CREATE DATABASE $DBNAME DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
DELETE FROM mysql.user WHERE user='$USER_USERNAME' and host='$USER_PASSWORD';
GRANT ALL PRIVILEGES ON $DBNAME.* to '$USER_USERNAME'@'$HOST' IDENTIFIED BY '$USER_PASSWORD' WITH GRANT OPTION;
EOF
)

echo $MySQL | mysql --user=$USERNAME --password=$PASSWORD

#install Grunt
echo "Do you wish to install Grunt program in global? (y/n) : \c"
read answer
if [ "$answer" = "Y" ] || [ "$answer" = "y" ]
then
    sudo npm install grunt -g
fi

#install Sass
echo "Do you wish to install Sass program in global? (require Ruby before) (y/n) : \c"
read answer
if [ "$answer" = "Y" ] || [ "$answer" = "y" ]
then
    sudo gem install sass
fi

#install Maildev
echo "Do you wish to install MailDev program in global? (y/n) : \c"
read answer
if [ "$answer" = "Y" ] || [ "$answer" = "y" ]
then
    sudo npm install -g maildev
fi

#Install dependencies node
echo "Install dependencies node"
sudo npm install

#create tables
echo "Create tables"
php artisan migrate
php artisan db:seed