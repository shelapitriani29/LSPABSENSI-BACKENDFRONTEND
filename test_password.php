<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Http\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::where('username', 'admin')->first();
echo "User found: " . ($user ? 'YES' : 'NO') . "\n";
if ($user) {
    echo "Username: " . $user->username . "\n";
    echo "Email: " . $user->email . "\n";
    echo "Role: " . $user->role . "\n";
    echo "Password hash exists: " . ($user->password ? 'YES' : 'NO') . "\n";
    echo "Password check for '1': " . (Hash::check('1', $user->password) ? 'PASS ✓' : 'FAIL ✗') . "\n";
}
