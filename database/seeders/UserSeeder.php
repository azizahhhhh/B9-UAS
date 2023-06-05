<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            "name" => "Admin Azizah",
            "email" => "adminazizah@gmail.com",
            "password" => bcrypt("password")
        ]);

        $pemilik_usaha = User::create([
            "name" => "Pemilik Usaha Azizah",
            "email" => "ownerazizah@gmail.com",
            "password" => bcrypt("password")
        ]);

        $supplier1 = User::create([
            "name" => "Supplier Azizah",
            "email" => "supplierazizah@gmail.com",
            "password" => bcrypt("password")
        ]);

        $supplier2 = User::create([
            "name" => "Supplier Isabel",
            "email" => "supplierisabel@gmail.com",
            "password" => bcrypt("password")
        ]);

        $admin->assignRole("Admin");
        $pemilik_usaha->assignRole("Pemilik Usaha");
        $supplier1->assignRole("Supplier");
        $supplier2->assignRole("Supplier");

    }
}
