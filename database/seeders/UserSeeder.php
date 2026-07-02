<?php

namespace Database\Seeders;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Buat 1 Akun
        User::create([
                'name'=>'Admin Myflorist',
                'email'=>'admin@myflorist.com',
                'password'=>Hash::make('admin123'),
            ]
        );
    }
}
