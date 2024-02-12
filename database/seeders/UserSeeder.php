<?php

namespace Database\Seeders;

use App\Models\User as ModelsUsers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsUsers::factory(1)->create();

        ModelsUsers::create([
            'first_name' => 'romi',
            'last_name' => 'ardana',
            'email' => 'romi@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'contact' => '2321-2323-2333',
            'role' => 'member',
        ]);

        ModelsUsers::create([
            'first_name' => 'brando',
            'last_name' => 'windah',
            'email' => 'brando@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'contact' => '2211-3333-2222',
            'role' => 'member',
        ]);
    }
}
