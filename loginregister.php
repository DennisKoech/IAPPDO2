<?php
session_start();
include_once './DBCon.php';
include_once './user.php';
$email = $_POST["email"];
echo $email;
$pass = $_POST["pass"];
echo $pass;
$con = new DBConnector();
$pdo = $con->connectToDB();
$user = new User();
$user->setEmail($email);
$user->setPassword($pass);
$user->login($pdo);

//Something Else
/* $result = $user->login($pdo);
$results=json_decode($result);
$_SESSION['name']=$results->NAME;
$_SESSION['location']=$result->LOCATION;
$_SESSION['email']=$email;
echo $results;
if(!empty($_SESSION['name']) && !empty($_SESSION['location'])){
    header("Location: ../IAPPDO2/usersLandingPage.php?SUCCESS");
}else{
    header("Location: ../IAPPDO2/Login.php?FAILURE");

} */
?>