<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use App\Models\User;
$u = User::first();
if ($u) {
    echo 'username: ' . $u->username . PHP_EOL;
    echo 'password: ' . $u->password . PHP_EOL;
    echo 'role: ' . $u->role . PHP_EOL;
    echo 'created at: ' . $u->created_at . PHP_EOL;
} else {
    echo 'no user' . PHP_EOL;
}
