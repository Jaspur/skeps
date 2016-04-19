<?php

use App\User;
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
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'sander@dekroon.xyz',
            'password' => bcrypt('wachtwoord'),
        ]);

        factory(App\User::class, 9)->create();
    }
}
