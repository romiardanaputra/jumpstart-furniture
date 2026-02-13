<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Attempting to create admin manually...\n";
    $admin = User::create([
        'first_name' => 'Admin',
        'last_name' => 'Support',
        'email' => 'admin@jumpstart.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
        'contact' => '081234567890',
    ]);
    echo "Success: Created Admin ID " . $admin->id . "\n";
    
    echo "Attempting to create user via factory...\n";
    $user = User::factory()->create([
        'role' => 'user'
    ]);
    echo "Success: Created User ID " . $user->id . "\n";
} catch (\Throwable $e) {
    echo "ERROR CLASS: " . get_class($e) . "\n";
    echo "ERROR MESSAGE: " . $e->getMessage() . "\n";
    if ($e instanceof \Illuminate\Database\QueryException) {
        echo "SQL: " . $e->getSql() . "\n";
        echo "BINDINGS: " . json_encode($e->getBindings()) . "\n";
    }
}
