<?php

include 'connect.php';

$data = json_decode(file_get_contents("php://input"));

$section = '';
if (isset($_GET['section'])) {
    $section = $_GET['section'];
}

switch ($section){
    case 'users':
        $statement = $conn->prepare("DELETE FROM users WHERE id=:id");
        $statement->execute(array(
            'id' => $data->id
        ));
        break;
    case 'restaurants':
        $statement = $conn->prepare("DELETE FROM restaurants WHERE id=:id");
        $statement->execute(array(
            'id' => $data->id
        ));
        break;
    case 'tables':
        $statement = $conn->prepare("DELETE FROM tables WHERE id=:id");
        $statement->execute(array(
            'id' => $data->id
        ));
        break;
    case 'categories':
        $statement = $conn->prepare("DELETE FROM categories WHERE id=:id");
        $statement->execute(array(
            'id' => $data->id
        ));
        break;
    case 'products':
        $statement = $conn->prepare("DELETE FROM products WHERE id=:id");
        $statement->execute(array(
            'id' => $data->id
        ));
        break;
    case 'orders':
        $statement = $conn->prepare("DELETE FROM orders WHERE id=:id");
        $statement->execute(array(
            'id' => $data->id
        ));
        break;
}
