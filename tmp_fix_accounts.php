<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$accounts = [
    ['username' => 'admin', 'email' => 'admin@lsp.com', 'role' => 'admin', 'name' => 'Administrator'],
    ['username' => 'asesor', 'email' => 'asesor@lsp.com', 'role' => 'asesor', 'name' => 'Asesor'],
    ['username' => 'peserta', 'email' => 'peserta@lsp.com', 'role' => 'peserta', 'name' => 'Peserta'],
];

foreach ($accounts as $acct) {
    $user = User::where('username', $acct['username'])->first();
    if ($user) {
        $user->email = $acct['email'];
        $user->role = $acct['role'];
        $user->name = $acct['name'];
        $user->status = 'Aktif';
        $user->password = Hash::make('1');
        $user->save();
        echo "Updated {$acct['username']}\n";
    } else {
        User::create([
            'name' => $acct['name'],
            'username' => $acct['username'],
            'email' => $acct['email'],
            'password' => Hash::make('1'),
            'role' => $acct['role'],
            'status' => 'Aktif',
        ]);
        echo "Created {$acct['username']}\n";
    }
}
