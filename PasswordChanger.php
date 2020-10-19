<?php
include_once './DBCon.php';
include_once './user.php';
$con = new DBConnnector();
$pdo = $con->connectToDB();
$user = new User();
$user->setPassword($password);
$user->changePassword($pdo);
?>