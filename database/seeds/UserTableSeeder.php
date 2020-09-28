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
        User::create([
            'name' => 'Ozil',
            'username' => 'Ozil10',
            'password' => bcrypt('password'),
            'email' =>'ozil@arsenal.com'
        ]);
    }
}
