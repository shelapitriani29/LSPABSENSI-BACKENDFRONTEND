<?php
require __DIR__ . '/vendor/autoload.php';

var_dump(class_exists('Barryvdh\\DomPDF\\Facade\\Pdf'));
var_dump(class_exists('Barryvdh\\DomPDF\\PDF'));

$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

var_dump(class_exists('Barryvdh\\DomPDF\\Facade\\Pdf'));
var_dump($app->bound('dompdf.wrapper'));

try {
    $wrapper = $app->make('dompdf.wrapper');
    var_dump(get_class($wrapper));
} catch (Throwable $e) {
    echo 'EX: ' . get_class($e) . ': ' . $e->getMessage() . PHP_EOL;
}
