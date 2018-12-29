<?php

use Illuminate\Database\Seeder;

use App\User;

class Users extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        User::create([
            'username'      => 'mr-exception',
            'email'         => 'darbandi1996@gmail.com',
            'password'      => Hash::make('reza1996'),
            'permission'    => User::NORMAL,
            'status'        => User::ACTIVE,
        ]);
    }
}
