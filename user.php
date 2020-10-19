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
            $stmt->execute([$this->getname(),$this->getEmail(),$hashedpass,$this->getLocation()]);
            $stmt = null;
            header("Location: ../IAPPDO2/LandingPage.php?success");
        }catch(PDOExecption $e){
            return $e->getMessage();
        }
    }
    public function login($pdo) {
        try{
            $stmt=$pdo->prepare("SELECT `NAME`, `EMAIL`, `PASS`, `LOCATION` FROM `users2` WHERE `EMAIL`= ?");
            $stmt->execute([$this->getEmail()]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = null;
            if($result==false){
                header("Location: ../IAPPDO2/Login.php?UserNotFound");
            }else{
                $password = password_verify($this->getPassword(),$result[`PASS`]);
                if($password){
                    $_SESSION['NAME']=$result['NAME'];
                    $_SESSION['LOCATION']=$result['LOCATION'];
                    $_SESSION['EMAIL']=$result['EMAIL'];
                    if(!empty($_SESSION['NAME']) && !empty($_SESSION['LOCATION'])){
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
    public function changePassword($pdo) {
        try{
            $stmt=$pdo->prepare("UPDATE users2 SET 'PASS' = ? ");
            $stmt->execute([$this->getPassword()]);
            $stmt = null;
        } catch (PDOException $e){
            return $e->getMessage();
        }
    }
    public function logout ($pdo){
        
    }
} 
?>