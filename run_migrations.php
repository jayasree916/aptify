<?php

require 'vendor/autoload.php';
require 'app/Config/Paths.php';

$paths = new Config\Paths();
$app = new CodeIgniter\CodeIgniter($paths);
$app->initialize();

$migrations = \Config\Services::migrations();
try {
    $migrations->latest();
    echo "Migrations ran successfully.";
} catch (\Exception $e) {
    echo "Error running migrations: " . $e->getMessage();
}
?>