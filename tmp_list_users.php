<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$users = User::all();
if ($users->isEmpty()) {
    echo "no user\n";
    exit;
}

foreach ($users as $u) {
    echo 'id:' . $u->id . ' | username:' . $u->username . ' | email:' . $u->email . ' | role:' . $u->role . ' | status:' . $u->status . "\n";
}
