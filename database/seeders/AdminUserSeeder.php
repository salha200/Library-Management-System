<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=User::create([
            'name' => 'yaso',
            'email' => 'yaso@gmail.com',  
            'password' => Hash::make('12345678910'), // 
            'is_admin' => true, // 
        ]);
    }
}
