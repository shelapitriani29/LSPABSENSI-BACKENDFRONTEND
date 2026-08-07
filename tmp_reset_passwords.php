<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$roles = ['admin', 'asesor', 'peserta'];
$users = User::whereIn('role', $roles)->get();
foreach ($users as $user) {
    $user->password = Hash::make('12345');
    $user->save();
    echo "updated {$user->username} ({$user->role})\n";
}
