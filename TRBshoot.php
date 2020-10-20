<?php

include_once './DBCon.php';
include_once './user.php';
$pass = "qwerat56";

$id = "2";
$con = new DBConnector();
$pdo = $con->connectToDB();
$user = new User();
$user->setPassword($pass);
$user->changePassword($pdo,$id);
echo "It hasnt worked";
?>