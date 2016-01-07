## E-Star-Wars


$ php artisan make:migration create_images_table --create=images
$ php artisan make:migration create_categories_table --create=categories
$ php artisan make:migration create_products_table --create=products

$ php artisan make:migration create_tags_table --create=tags
$ php artisan make:migration create_customers_table --create=customers
$ php artisan make:migration create_orders_table --create=orders

$ php artisan make:migration create_product_tag_table --create=product_tag
$ php artisan make:migration create_customer_product_table --create=customer_product
$ php artisan make:migration create_order_product_table --create=order_product


//////////////////////////////// MODELE ////////////////////////////////
$ php artisan make:model Image
$ php artisan make:model Category
$ php artisan make:model Product
$ php artisan make:model Tag
$ php artisan make:model Customer
$ php artisan make:model Order


//////////////////////////////// SEEDER ////////////////////////////////
$ php artisan make:seeder UserTableSeeder
$ php artisan make:seeder ProductTableSeeder
$ php artisan make:seeder ImageTableSeeder
$ php artisan make:seeder TagTableSeeder
$ php artisan make:seeder CategoryTableSeeder
$ php artisan make:seeder CustomerTableSeeder
$ php artisan make:seeder OrderTableSeeder

$ php artisan migrate:refresh --seed
$ php artisan db:seed


//////////////////////////////// MODELES ////////////////////////////////
belongsTo       = N..1
hasMany         = 1..N
belongsToMany   = N..N

->  associer les 3 tables pivots via tinker - tinker (écrire les relations dans les modeles avant) :
    $ $products = App\Product::find(1);
    $ $products->tags()->sync([2,3]);


//////////////////////////////// CONTROLLER ////////////////////////////////
$ php artisan make:controller FrontController --plain
$ php artisan make:controller ProductController
$ php artisan make:controller BagController --plain
$ php artisan make:controller OrderController --plain


//////////////////////////////// RULES FORMS ////////////////////////////////
php artisan make:request ProductFormRequest
php artisan make:request LoginFormRequest
php artisan make:request LoginCustomerFormRequest
php artisan make:request ContactFormRequest

            'customer_name' => 'required|max:255',
            'customer_email'=> 'required|email',

//////////////////////////////// MAIL DEV ////////////////////////////////
maildev
-> http://localhost:1080/
test Akismet : viagra-test-123


//////////////////////////////// GRUNT + SASS ////////////////////////////////
$ sudo gem install -n /usr/local/bin sass
$ grunt


//////////////////////////////// DATE PROBLEMATIQUE ////////////////////////////////
input de type 'date' envoi bien une valeur en bdd || Par contre, coté vue, ca affiche jj/mm/aaaa et non la vrai date
solution =>
    - changer l'input en type 'text'
    - mettre en place un datePicker
    - formater la date anvent l'envoi en bdd (->format('Y-m-d...'))



########################################################################################
# Documentation pour l'installation et le déploiement du projet :

$ cd myFolderProject

Créer une base de donnée puis définir la connection à celle-ci dans .env

Lancer les serveurs :
    $ php artisan serve
    -> lancer MAMP ou XAMP pour le SQL

Installer les dépendances :
    $ composer install
    $ npm install

    Dépendances installés via Composer :
        - laravel-debugbar
        - illuminate/html
        - intervention/image
        - nickurt/laravel-akismet

    Dépendances installés via Node.JS :
        - grunt (compass, sass, unglify, jshint, watch, cssmin, grunt-tasks)
        - jquery
        - jquery-ui
        - jquery.easing

Creer les tables dans la base de donnée et du "faux" contenu :
    $ php artisan migrate
    $ php artisan db:seed

Pour lancer Grunt :
    $ grunt
    $ grunt watch

Pour lancer le serveur devmail :
    $ maildev
    -> http://localhost:1080/
    pour tester Akismet, ecrire dans le champ "message" de la page contact les mots suivant : viagra-test-123

Pour créer/modifier des produits :
    J'ai préparé 10 images (5 pour chaque catégorie) qui se trouvent dans myFolderStarwars/public/assets/img


NAGIVATION :
    Pour se connecter en tant qu'administrateur :
    email    : pierre@gmail.com
    password : 1111

    Pour se connecter en tant que client et valider une commande :
        reprendre le nom et l'email d'un client dans la table 'customers'


######################################## Silde ################################################

1) Mettre mon logo + Socialshaker (expliquer se que je fait + aps)
2) le sujet + les problematiques
    - réalisation d'un site e-commerce en version simplifier
    - Ce site vendra des objets de la saga StarWars
    - 2 parties : Accès privé | site publique
    - Possibilité de commander un/plusieurs produits (1 compte clients sera deja engerister en bdd)
    - Possibilité d'administer les produits va un CRUD (Créer / modifier / supprimer) (seul les produits seront administrable)
    - Présence de 2 catégorie "Laser" et "Casques"
    - tags associé (4 max)
    - Possibilité d'envoyer un message via formulaire de contact
    - Possibilité d'afficher toute les commande réaliser coté publique
    - les clients, tags, catégories seront deja prédéfini dans la base de donnée.


3) présenter mon travail :
    - Frameworks et technologies utilisées
        - organisation : trello (taches par taches)
        - versionning : git et Github
        - MySQlWorkbench : generer un diagramme
        - Laravel 5
        - Bootstrap
        - Sass + compass
        - Task Runner : Grunt
        - Node JS
        -
    - Arborescence des pages
        Coté publique :
            - #Page d'accueil.
            - #Page d'un produit (détails du produit).
            - Page de contact.
            - Mentions légales.
            - Une page panier.
            - Une page validation commande.
            - Page de login à l'espace privé.
        Coté administration :
            - #page dashboard
            - #page "creer" un produit
            - page "modifier" un produit
            - page "historique des commandes"
            - page "historique des commandes non payés"
    - Ensemble des fonctionnalités développées
        front :
            - parallax (js + '.scroll' de jquery)
            - animation au scroll
            - datePicker
        back :
            - 2 authentification (administrateur & client)
            - messages flashs (succes ou erreurs)
            - Un panier dont les produit sont temporairement mémoriser dans des sessions laravel
            - système de gestion d'erreurs (form request)

    - Structure des données (tables et relations)
        - afficher le diagramme
        - faux contenu generer avec "Faker"

4) demo fonctionnelle du site (montrer l’ensemble de mon travail)
    - envoyer un email
    - akismet
    - htmlentities
    - creer/modifier/supprimer un produit
    - le panier->valider une commande
    - afficher l'historique des commandes + les non payées
    -

5) Les problématique de développement
    - problème rencontré et résolue :
        - datPicker
        - date format fr
        - generer un extrait a partir du content
        - generer une miniature a partir d'une image
        - page panier : stocker les id des produits + leurs quantités associés
    - algorithme apportant une plus value importante :
        -
    - Hiérarchie de classe
        -
    - Fonctionnalité supplémentaire développée :
       - parallax (js + '.scroll' de jquery)
       - animation au scroll
       - datePicker
       - possiblité d'inscrire de nouveau administrateur

6) Conclusion :
    - Améliorations possibles
        - Rendre les catégories et les tags administrable
        - Créer une auth cliens + espace client
        - Rendre l'historique des commande administrable
        - gestion des stocks et
        - des frais de livraisons
    - Compétences apportées
        - amélioration de mes compétences en PHP + SQL/BDD + Laravel



######################################## MEMO JOUR J ################################################
CRUD : Create, Read, Update, Delete (stockage d'informations en base de données)

Les formulaires :
    tester 'mail dev'
    tester 'Akismet'      http://localhost:1080/    viagra-test-123
    tester les htmlentities
    tester gestion des erreurs (formRequest)


