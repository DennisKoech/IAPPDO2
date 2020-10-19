<?php
include_once './DBCon.php';
include_once './user.php';

$name = $_POST["name"];
$email= $_POST["email"];
$password= $_POST["pass"];
$location= $_POST["location"];
$con = new DBConnector();
$pdo = $con->connectToDB();
$user = new User();
$user->setFullName($name);
$user->setEmail($email);
$user->setLocation($location);
$user->setPassword($password);
echo $user->register($pdo);
?>