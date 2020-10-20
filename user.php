<?php
session_start ();
include_once './Account.php';
class User implements Account{
        private $fullName;
        private $email;
        private $password;
        private $city;
    public function __construct(){

    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setFullName($name){
        $this->fullname = $name;
    }
    public function setPassword($pass){
        $this->password = $pass;
    }
    public function setLocation($location){
        $this->city = $location;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getname(){
        return $this->fullname;
    }
    public function getLocation(){
        return $this->city;
    }
    public function getPassword(){
        return $this->password;
    }
    public function register ($pdo){
        $hashedpass = password_hash($this->getPassword(), PASSWORD_DEFAULT);
        try{
            $stmt=$pdo->prepare("INSERT INTO `users2`(`NAME`, `EMAIL`, `PASS`, `LOCATION`) VALUES (?,?,?,?)");
            $stmt->execute([$this->getname(),$this->getEmail(),$this->getPassword(),$this->getLocation()]);
            $stmt = null;
            header("Location: ../IAPPDO2/LandingPage.php?success");
        }catch(PDOExecption $e){
            return $e->getMessage();
        }
    }
    public function login($pdo) {
        try{
            $stmt=$pdo->prepare("SELECT `ID`,`NAME`, `EMAIL`, `PASS`, `LOCATION` FROM `users2` WHERE `EMAIL`= ?");
            $stmt->execute([$this->getEmail()]);
            $result = $stmt->fetch();
            $stmt = null;
            $_SESSION['NAME1']=$result['NAME'];
            $_SESSION['LOCATION1']=$result['LOCATION'];
            $_SESSION['EMAIL1']=$result['EMAIL'];
            $_SESSION['PASS']= !password_verify($this->getPassword(),$result['PASS']);
            if($result==false){
                header("Location: ../IAPPDO2/Login.php?UserNotFound");
            }else{
                $password = password_verify($this->getPassword(),$result[`PASS`]);
                if($result['PASS']==$this->getPassword()){
                    $_SESSION['ID']=$result['ID'];
                    $_SESSION['NAME']=$result['NAME'];
                    $_SESSION['LOCATION']=$result['LOCATION'];
                    $_SESSION['EMAIL']=$result['EMAIL'];
                    if(!empty($_SESSION['NAME']) || !empty($_SESSION['LOCATION'])){
                        header("Location: ../IAPPDO2/usersLandingPage.php?SUCCESS");
                    }else{
                        header("Location: ../IAPPDO2/Login.php?FAILURE");
                    
                    }   
                }else{
                    header("Location: ../IAPPDO2/Login.php?IncorrectPassword");
                }
            }
        }catch (PDOExecption $e){
            return $e->getMesage();
        }
    }
    public function changePassword($pdo,$id) {
        try{
            $stmt=$pdo->prepare(
                "UPDATE `users2` 
                SET `PASS` = ? 
                WHERE `ID` = $id"
                );
            $stmt->execute([$this->getPassword()]);
            $stmt = null;
            header("Location: ../IAPPDO2/usersLandingPage.php?passchange=success");
        } catch (PDOException $e){
            return $e->getMessage();
        }
    }
    public function logout ($pdo){
        header("Location: ../IAPPDO2/Logout.php");
    }
} 
?>