<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name'     => 'pierre',
                'email'    => 'pierre@gmail.com',
                'password' => Hash::make('1111'),
            ]);

    }
}
