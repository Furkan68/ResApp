<?php

include 'connect.php';

$data = json_decode(file_get_contents("php://input"));

$section = '';
if (isset($_GET['section'])) {
    $section = $_GET['section'];
}

switch ($section){
    case 'delivered':
        $statement = $conn->prepare("UPDATE orders SET delivered=:delivered WHERE id=:id");
        $statement->execute(array(
            'delivered' => 1,
            'id' => $data->id
        ));
        break;
    case 'inprogress':
        $statement = $conn->prepare("UPDATE orders SET inprogress=:inprogress WHERE id=:id");
        $statement->execute(array(
            'inprogress' => 1,
            'id' => $data->id
        ));
        break;
}
