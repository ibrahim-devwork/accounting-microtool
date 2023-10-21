<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user           = new User();
        $user->name     = "Ibrahim";
        $user->email    = "a@gmail.com";
        $user->role     = "Admin";
        $user->password = Hash::make('12345678');
        $user->save();
    }
}