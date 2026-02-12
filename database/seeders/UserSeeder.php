<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        
        // Admin
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Support',
            'email' => 'admin@jumpstart.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'contact' => '081234567890',
        ]);

        // 30 random users
        User::factory()->count(30)->create(['role' => 'user']);
    }
}
