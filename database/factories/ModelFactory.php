<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/*
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
*/




$factory->define(App\Image::class, function (Faker\Generator $faker) {
    return [
        'name'          => $faker->word(1).'jpg',
        'uri'           => $faker->imageUrl($width = 140, $height = 180),
        'status'        => rand(0,1),
        'published_at'  => Carbon\Carbon::now()
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'title'          => $faker->word(1),
        'description'    => $faker->paragraph(1)
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'title'         => $faker->word(1),
        'abstract'      => $faker->paragraph(1),
        'content'       => $faker->paragraph(4),
        'price'         => rand(1,100),
        'status'        => rand(0,1),
        'published_at'  => Carbon\Carbon::now(),
        'image_id'      => rand(1,3),
        'category_id'   => rand(1,2)
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name'          => $faker->word(1)
    ];
});

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    return [
        'username'       => $faker->name,
        'email'          => $faker->email
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    return [
        'total_price'       => rand(1,100),
        'commanded_at'      => Carbon\Carbon::now(),
        'status'            => rand(0,1),
        'customer_id'       => rand(1,3)
    ];
});




