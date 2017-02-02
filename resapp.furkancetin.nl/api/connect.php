<?php

$username = '36485_1';
$password = 'Kpq0h1!9';

try {
    $conn = new PDO('mysql:host=localhost:3306;dbname=resapp', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}