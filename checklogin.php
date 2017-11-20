<?php
include('includes/db-config.inc.php');

if(isset($_POST['username']) && isset($_POST['password'])){
    
    $salt = getSalt($_POST['username']);
    
    /*If the salt does not equal null or is not blank then the file will 
      concatnate it with the password inputted by the user and MD5 it. 
      
      The MD5'ed password will be checked against the database password after to see if 
      there is match.
    */
    if ($salt !== null && $salt != ""){
        $passwordSalt = $_POST['password']. $salt;
        $passwordSalt = md5($passwordSalt);
        
        $dbPassword = getPassword($_POST['username']);
        
        if($dbPassword == $passwordSalt){
            
            //Get the UserID for the corresponding username.
            $userID = getUserID($_POST['username']);
            
            //Passwords match, setting up session variables (userid, first name, last name, password)
            setSessionVariables($userID);
            
            //If the pagename session varible is set, return to the prior page. If not, go to index.
            if(isset($_SESSION['pagename'])){
                header("location:index.php" . $_SESSION['pagename']);
            }
            else{
            header("location:index.php");
            }
        }
        else{
            //Passwords don't match, send user back to login page to retry.
            header("location:login.php?error=1");
        };
    }else{
        //Null or no corresponding salt for the username provided. Send user back to login page to retry. 
        header("location:login.php?error=1");
    }
}

//Function to get the UserID for the corresponding username from the UserLogin table.
function getUserID($username){
    $connection = getConnection();
    $sql = "SELECT UserID FROM UsersLogin WHERE UserName = ?";
    $statement  = DatabaseHelper::runQuery($connection, $sql, $username);
    while ($row = $statement->fetch()) {
        $salt = $row['UserID'];
        return $salt;
    }
    
    return null;
}

//Function to get the salt for the corresponding username from the UserLogin table.
function getSalt($username){
    $connection = getConnection();
    $sql = "SELECT Salt FROM UsersLogin WHERE UserName = ?";
    $statement  = DatabaseHelper::runQuery($connection, $sql, $username);
    while ($row = $statement->fetch()) {
        $salt = $row['Salt'];
        return $salt;
    }
    
    return null;
}

//Get the password for the corresponding username.
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

//Set session variables after the correct username and password are supplied.
function setSessionVariables($userid){
    $connection = getConnection();
    $sql = "SELECT FirstName, LastName, Email From Users WHERE UserID = ?";
    $statement  = DatabaseHelper::runQuery($connection, $sql, $userid);
    
    while ($row = $statement->fetch()) {
    session_start();
    
    $_SESSION['userid'] = $userid;
    $_SESSION['firstname'] = $row["FirstName"];
    $_SESSION['lastname'] = $row["LastName"];
    $_SESSION['email'] = $row['Email'];
    }
}
?>