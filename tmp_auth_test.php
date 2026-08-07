<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
$user = User::where('username', 'yuda')->first();
if (!$user) {
    echo "User not found\n";
    exit;
}
$password = 'password';
$check = Hash::check($password, $user->password);
echo "Username: {$user->username}\n";
echo "Password hash: {$user->password}\n";
echo "Hash::check('{$password}') => " . ($check ? 'true' : 'false') . "\n";
$attempt = Auth::attempt(['username' => $user->username, 'password' => $password]);
echo "Auth::attempt => " . ($attempt ? 'true' : 'false') . "\n";
