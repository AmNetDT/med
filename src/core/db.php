<?php

$username = 'root';
$password = 'Netplus!1234';

try {
    // first connect to database with the PDO object. 
    $connection = new \PDO('mysql:host=localhost;dbname=riladb', $username, $password, [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (\PDOException $e) {
    // if connection fails, show PDO error. 
    echo "Error connecting to mysql: " . $e->getMessage();
}
?>