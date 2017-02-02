<?php

include "connect.php";

$data = '';
$data2 = '';

$_SESSION['restaurantid'] = $_SERVER['HTTP_RESTAURANTID'];
$_SESSION['tablenumber'] = $_SERVER['HTTP_TABLE'];

$statement = $conn->prepare("SELECT * FROM restaurants WHERE id = :id");
$statement->execute(array(
    'id' => $_SERVER['HTTP_RESTAURANTID']
));

while ($row = $statement->fetch()) {
    $data = $row;
}

$_SESSION['restaurant'] = $data['name'];


$statement2 = $conn->prepare("SELECT * FROM tables WHERE number = :tablenumber");
$statement2->execute(array(
    'tablenumber' => $_SERVER['HTTP_TABLE']
));

while ($row2 = $statement2->fetch()) {
    $data2 = $row2;
}

$_SESSION['tableid'] = $data2['id'];



