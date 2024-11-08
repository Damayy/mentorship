<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $userData = [
            [
                'name'=> 'Adminn',
                'nik'=> '1212121212121212',
                'email'=> 'adminn@gmail.com',
                'password'=> bcrypt(123456),
                'role'=> 'admin'
            ],
            [
                'name'=> 'Aurora',
                'nik'=> '6666666666666666',
                'email'=> 'aurora@gmail.com',
                'password'=> bcrypt(123456),
                'role'=> 'warga'
            ],
        ];

        foreach ($userData as $key => $val){
            User::create($val);
        }
    }
}
