<?php 
session_start(); 

if (isset($_POST['loginForm'])) { 
     
    include 'dbConnection.php'; 
     
    $dbConn = getConnection(); 
     
    $sql = "SELECT * FROM users
            WHERE username = :username
            AND password = :password"; 
             
    $namedParameters = array();         
    $namedParameters[":username"]  = $_POST['username']; 
    $namedParameters[":password"] = sha1($_POST['password']); 
     
    $stmt = $dbConn->prepare($sql); 
    $stmt->execute($namedParameters); 
    $result = $stmt->fetch(); 
     
    if (empty($result)) { 
        header("Location: login.html?error='wrong username'"); 
    } else { 
         
        $_SESSION["username"] = $result["username"]; 
        $_SESSION["profilePicture"] = $result["profilePicture"];
        
        header("Location: profile.php"); 
         
    } 
     
     
} 
