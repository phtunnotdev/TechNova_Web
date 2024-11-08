<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Tạo seeder admin
        User::create([
            'user_code' => "AD-" . Str::random(5),
            'name' => "Admin TechNova",
            'email' => "admintechnova24@gmail.com",
            'show_password' => "adminwd24",
            'role' => 1,
            'password' => Hash::make("adminwd24")
        ]);

        //Taọ 100 bảng ghi từ userFactory
        User::factory()->count(1000)->create();
    }
}