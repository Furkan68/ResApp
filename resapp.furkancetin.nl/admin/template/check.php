<?php
session_start();
if(isset($_SESSION['active'])){
    if($_SESSION['active'] == false){
        header("Location: http://resapp.furkancetin.nl/admin/login/");
        die();
    }
}else{
    header("Location: http://resapp.furkancetin.nl/admin/login/");
    die();
}
