<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=lspabsensi;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query('SELECT id, username, role FROM users');
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['id'] . ' | ' . ($row['username'] ?? 'NULL') . ' | ' . ($row['role'] ?? 'NULL') . PHP_EOL;
    }
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
}
