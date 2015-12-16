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

$ php artisan db:seed

->  associer les 3 tables pivots via tinker - tinker (écrire les relations dans les modeles avant) :
    $ $products = App\Product::find(1);
    $ $products->tags()->sync([2,3]);


belongsTo       = N..1
hasMany         = 1..N
belongsToMany   = N..N