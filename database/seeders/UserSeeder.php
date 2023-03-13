<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "super sdmin",
            "email" => "super@test.mail",
            "password" => Hash::make("super"),
        ])->assignRole("Super Admin");

        User::create([
            "name" => "admin",
            "email" => "admin@test.mail",
            "password" => Hash::make("admin"),
        ])->assignRole("Admin");

        User::create([
            "name" => "gestionnaire",
            "email" => "gestionnaire@test.mail",
            "password" => Hash::make("gestionnaire")
        ])->assignRole("Gestionnaire");
    }

        //User::factory(1)->create();


}
