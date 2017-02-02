<?php

include 'connect.php';

$result = [];
$json = [];
$data = json_decode(file_get_contents("php://input"));

$username = $data->username;
$password = $data->password;

$statement = $conn->prepare("SELECT * FROM users WHERE users.username = '$username'");
$statement->execute(array());
while ($row = $statement->fetch()) {
    $result = $row;
}


if ($result['password'] == $password) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $result['role'];
    $_SESSION['restaurantid'] = $result['restaurantid'];
    $_SESSION['active'] = true;

    $json = [
        'username' => $username,
        'role' => $result['role'],
        'restaurantid' => $result['restaurantid'],
        'active' => true
    ];

} else {
    $json = [
        'active' => false
    ];
}


print json_encode($json);
