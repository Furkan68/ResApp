<?php

$username = '';
$password = '';

try {
    $conn = new PDO('mysql:host=localhost:3306;dbname=resapp', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
