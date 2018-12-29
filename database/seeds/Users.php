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
            'password'      => Hash::make('1996'),
            'permission'    => User::NORMAL,
            'status'        => User::ACTIVE,
        ]);

        User::create([
            'username'      => 'alireza',
            'email'         => 'alireza@gmail.com',
            'password'      => Hash::make('1996'),
            'permission'    => User::NORMAL,
            'status'        => User::ACTIVE,
        ]);
        User::create([
            'username'      => 'amirreza',
            'email'         => 'amirreza@gmail.com',
            'password'      => Hash::make('1996'),
            'permission'    => User::NORMAL,
            'status'        => User::ACTIVE,
        ]);
        User::create([
            'username'      => 'sadegzeini',
            'email'         => 'sadegzeini@gmail.com',
            'password'      => Hash::make('1996'),
            'permission'    => User::NORMAL,
            'status'        => User::ACTIVE,
        ]);
        User::create([
            'username'      => 'saberabar',
            'email'         => 'saberabar@gmail.com',
            'password'      => Hash::make('1996'),
            'permission'    => User::NORMAL,
            'status'        => User::ACTIVE,
        ]);
    }
}
