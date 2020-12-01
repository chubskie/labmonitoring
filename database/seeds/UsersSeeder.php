<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = new User;

    	$user->username = 'McPerry_';
    	$user->name = 'Co, Mack Perry L.';
    	$user->password = Hash::make('123456789');

    	$user->save();
    }
}
