<?php

$DBuser = 'root';
$DBpass = 'coffee';
$pdo = null;

try {
    $database = 'mysql:host=database:3306';
    $pdo = new PDO($database, $DBuser, $DBpass);
    echo 'Looking good, php connected to mysql successfully.';
} catch (PDOException $e) {
    echo "php connection to mysql failed with:\n $e";
}

$pdo = null;
