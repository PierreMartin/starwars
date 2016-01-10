<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Category::class, 2)->create();

        DB::table('categories')->insert(
            [
                'title'         => 'Lasers',
                'description'   => 'La catégorie des sabres lasers'
            ])->insert(
            [
                'title'         => 'Casques',
                'description'   => 'La catégorie des casques'
            ]);
    }
}
