<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Core\Uuid;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        User::create([
            'name' => 'Admin',
             'uid' => Str::uuid(),
             'role' => 1,
            'email'=>'super@gmail.com',
            'phone' => '1234567890',
            'password' => Hash::make('12345')
        ]);
    }
}
