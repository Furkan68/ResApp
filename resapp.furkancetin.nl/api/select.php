<?php

include 'connect.php';

$section = '';
$statement = '';
$restaurantid = '';
$categoryid = '';
$tableid = '';

if (isset($_GET['section'])) {
    $section = $_GET['section'];
}
if (isset($_GET['restaurantid'])) {
    $restaurantid = $_GET['restaurantid'];
}
if (isset($_GET['tableid'])) {
    $tableid = $_GET['tableid'];
}
if (isset($_GET['categoryid'])) {
    $categoryid = $_GET['categoryid'];
}

switch ($section) {
    case 'users':
        $statement = $conn->prepare('SELECT users.id, users.username, users.password, users.restaurantid, restaurants.name as restaurant
        FROM users
        INNER JOIN restaurants
        ON users.restaurantid=restaurants.id
        WHERE users.restaurantid > 1');
        $statement->execute(array());
        break;
    case 'restaurants':
        $statement = $conn->prepare('SELECT * FROM restaurants WHERE id > 1');
        $statement->execute(array());
        break;
    case 'tables':
        $statement = $conn->prepare("SELECT * FROM tables WHERE restaurantid = :restaurantid");
        $statement->execute(array(
            'restaurantid' => $restaurantid
        ));
        break;
    case 'categories':
        $statement = $conn->prepare("SELECT * FROM categories WHERE restaurantid = :restaurantid");
        $statement->execute(array(
            'restaurantid' => $restaurantid
        ));
        break;
    case 'products':
        $statement = $conn->prepare('SELECT products.id, products.name, products.description, products.price, products.categoryid, categories.name as category
        FROM products
        INNER JOIN categories
        ON products.categoryid = categories.id 
        WHERE products.restaurantid = :restaurantid');
        $statement->execute(array(
            'restaurantid' => $restaurantid
        ));
        break;
    case 'productsbycategory':
        if ($categoryid == 0 || $categoryid == null) {
            $statement = $conn->prepare('SELECT *
        FROM products
        WHERE restaurantid = :restaurantid');
            $statement->execute(array(
                'restaurantid' => $restaurantid
            ));
        } else {
            $statement = $conn->prepare('SELECT *
        FROM products
        WHERE restaurantid = :restaurantid AND categoryid = :categoryid');
            $statement->execute(array(
                'restaurantid' => $restaurantid,
                'categoryid' => $categoryid
            ));
        }
        break;
    case 'orders':
        $statement = $conn->prepare('SELECT orders.id, orders.amount, orders.inprogress, orders.productid, products.price as productprice, products.name as product
        FROM orders
        INNER JOIN products
        ON orders.productid = products.id 
        WHERE orders.restaurantid = :restaurantid
        AND orders.tableid = :tableid
        AND orders.delivered = 0');
        $statement->execute(array(
            'restaurantid' => $restaurantid,
            'tableid' => $tableid
        ));
        break;
    case 'ordersForUser':
        $statement = $conn->prepare('SELECT orders.id, orders.amount, orders.inprogress, orders.delivered, orders.tableid, tables.number as tablenumber, products.price as productprice, products.name as product
        FROM orders
        INNER JOIN products ON orders.productid = products.id 
        INNER JOIN tables ON orders.tableid = tables.id 
        WHERE orders.restaurantid = :restaurantid
        AND orders.delivered = 0');
        $statement->execute(array(
            'restaurantid' => $restaurantid
        ));
        break;
}


while ($row = $statement->fetch()) {
    $data[] = $row;
}

print json_encode($data);
