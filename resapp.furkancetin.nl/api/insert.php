<?php
session_start();

include 'connect.php';

$data = json_decode(file_get_contents("php://input"));

$buttonName = $data->buttonName;

$section = '';
if (isset($_GET['section'])) {
    $section = $_GET['section'];
}

if ($buttonName == "Toevoegen") {
    switch ($section) {
        case 'users':
            $statement = $conn->prepare("INSERT INTO users (username, password, restaurantid) VALUES (:username, :password, :restaurantid)");
            $statement->execute(array(
                'username' => $data->username,
                'password' => $data->password,
                'restaurantid' => $data->restaurantid
            ));
            break;
        case 'restaurants':
            $statement = $conn->prepare("INSERT INTO restaurants (name) VALUES (:name)");
            $statement->execute(array(
                'name' => $data->name
            ));
            break;
        case 'tables':
            $statement = $conn->prepare("INSERT INTO tables (number, restaurantid) VALUES (:number, :restaurantid)");
            $statement->execute(array(
                'number' => $data->number,
                'restaurantid' => $_SESSION['restaurantid']
            ));
            break;
        case 'categories':
            $statement = $conn->prepare("INSERT INTO categories (name, restaurantid) VALUES (:name, :restaurantid)");
            $statement->execute(array(
                'name' => $data->name,
                'restaurantid' => $_SESSION['restaurantid']
            ));
            break;
        case 'products':
            $statement = $conn->prepare("INSERT INTO products (name, description, price, categoryid, restaurantid) VALUES (:name, :description, :price, :categoryid, :restaurantid)");
            $statement->execute(array(
                'name' => $data->name,
                'description' => $data->description,
                'price' => $data->price,
                'categoryid' => $data->categoryid,
                'restaurantid' => $_SESSION['restaurantid']
            ));
            break;
    }
} elseif ($buttonName == "Bijwerken") {
    switch ($section) {
        case 'users':
            $statement = $conn->prepare("UPDATE users SET username=:username, password=:password, restaurantid=:restaurantid WHERE id=:id");
            $statement->execute(array(
                'username' => $data->username,
                'password' => $data->password,
                'restaurantid' => $data->restaurantid,
                'id' => $data->id
            ));
            break;
        case 'restaurants':
            $statement = $conn->prepare("UPDATE restaurants SET name=:name WHERE id=:id");
            $statement->execute(array(
                'name' => $data->name,
                'id' => $data->id
            ));
            break;
        case 'tables':
            $statement = $conn->prepare("UPDATE tables SET number=:number WHERE id=:id");
            $statement->execute(array(
                'number' => $data->number,
                'id' => $data->id
            ));
            break;
        case 'categories':
            $statement = $conn->prepare("UPDATE categories SET name=:name WHERE id=:id");
            $statement->execute(array(
                'name' => $data->name,
                'id' => $data->id
            ));
            break;
        case 'products':
            $statement = $conn->prepare("UPDATE products SET name=:name, description=:description, price=:price, categoryid=:categoryid WHERE id=:id");
            $statement->execute(array(
                'name' => $data->name,
                'description' => $data->description,
                'price' => $data->price,
                'categoryid' => $data->categoryid,
                'id' => $data->id
            ));
            break;
    }
}else{
    if($section == 'order'){
        echo $data->ammount;
        $statement = $conn->prepare("INSERT INTO orders (tableid, productid, restaurantid, amount) VALUES (:tableid, :productid, :restaurantid, :amount)");
        $statement->execute(array(
            'tableid' => $_SESSION['tableid'],
            'productid' => $data->productid,
            'restaurantid' => $_SESSION['restaurantid'],
            'amount' => $data->amount
        ));
    }
}
