<?php
require __DIR__ . '/vendor/autoload.php';
$config = require __DIR__ . '/config/database.php';
$connection = $config['connections'][$config['default']];
$dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=%s', $connection['host'], $connection['port'], $connection['database'], $connection['charset']);
try {
    $pdo = new PDO($dsn, $connection['username'], $connection['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $stmt = $pdo->query('SELECT id, username, role FROM users');
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['id'] . ' | ' . ($row['username'] ?? 'NULL') . ' | ' . ($row['role'] ?? 'NULL') . PHP_EOL;
    }
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
}
