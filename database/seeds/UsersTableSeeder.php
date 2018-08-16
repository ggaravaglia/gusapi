<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'email' => str_random(10).'@gmail.com',
            'password' => app('hash')->make('secret'),
            'api_token' => str_random(40)
        ]);
    }
}
