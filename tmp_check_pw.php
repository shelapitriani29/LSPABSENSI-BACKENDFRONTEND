<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$usernames = ['admin', 'asesor', 'peserta'];
$candidates = ['1', '12345', 'password', 'admin'];

foreach ($usernames as $username) {
    $u = User::where('username', $username)->first();
    if (!$u) {
        echo "username $username: MISSING\n";
        continue;
    }
    echo "username $username | email: {$u->email} | role: {$u->role} | status: {$u->status}\n";
    foreach ($candidates as $p) {
        echo '    ' . $p . ': ' . (Hash::check($p, $u->password) ? 'MATCH' : 'NO') . "\n";
    }
}
