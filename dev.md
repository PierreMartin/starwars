# E-Star-Wars

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
Dépendances installés via Composer :
    - laravel-debugbar
    - illuminate/html
    - intervention/image
    - nickurt/laravel-akismet

Dépendances installés via Node.JS :
    - grunt (compass, sass, uglify, jshint, watch, cssmin, grunt-tasks)
    - jquery
    - jquery-ui
    - jquery.easing

$ php artisan migrate
$ php artisan db:seed

######################################## demo fonctionnelle du site ################################################
- creer/modifier/supprimer un produit
- afficher l'historique des commandes + les non payées
- valider une commande :
    - en faisant une erreur dans l'auth client (flash error)
    - sans erreur

Le formulaire de contact :
    tester 'mail dev'
    tester 'Akismet'      http://localhost:1080/    viagra-test-123
    tester les htmlentities
    tester gestion des erreurs (form Request Validation)

CRUD : Create, Read, Update, Delete (stockage d'informations en base de données)