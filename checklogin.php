<?php
include('includes/db-config.inc.php');

if(isset($_POST['username']) && isset($_POST['password'])){
    $salt = checkUser($_POST['username']);
    
    if ($salt !== null && $salt != ""){
        $passwordSalt = $_POST['password']. $salt;
        $passwordSalt = md5($passwordSalt);
        
        //check password
        echo $passwordSalt . " " . $_POST['password'];
        
        $dbPassword = getPassword($_POST['username']);
        if($dbPassword == $passwordSalt){
            setSessionVariables();
            if(isset($_SESSION['pagename'])){
                header("location:index.php" . $_SESSION['pagename']);
            }
            else{
            header("location:index.php");
            }
        }
        else{
            header("location:login.php?error=1");
        };
    }else{
        header("location:login.php?error=1");
    }
}

function checkUser($username){
    $connection = getConnection();
    $sql = "SELECT Salt FROM UsersLogin WHERE UserName = ?";
    $statement  = DatabaseHelper::runQuery($connection, $sql, $username);
    while ($row = $statement->fetch()) {
        $salt = $row['Salt'];
        return $salt;
    }
    
    return null;
}

function getPassword($username){
    $connection = getConnection();
    $sql = "SELECT Password FROM UsersLogin WHERE UserName = ?";
    $statement  = DatabaseHelper::runQuery($connection, $sql, $username);
    while ($row = $statement->fetch()) {
        $password = $row['Password'];
        return $password;
    }
    
    return null;
}

function setSessionVariables(){
    session_start();
    $_SESSION['userid'] = 'test';
}
?>