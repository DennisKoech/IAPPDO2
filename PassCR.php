<?php
include_once './DBCon.php';
include_once './user.php';
$pass = $_POST['pass'];
$conpass = $_POST['Conpass'];
$id = $_SESSION['ID'];
$con = new DBConnector();
$pdo = $con->connectToDB();
$user = new User();
if($pass == $conpass){
    $user->setPassword($pass);
    $user->changePassword($pdo,$id);
}else{
    header ("Location: ../IAPPDO2/PassChange.php?Re-enterPassword");
}
?>