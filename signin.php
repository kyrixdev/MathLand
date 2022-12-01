<?php
    session_start();
    require_once("connect.php");
    include_once("controllers/header.php");
    
    //Login Part 
    if(isset($_SESSION['UserLoggedIn']))   // Checking whether the session is already there or not if 
                                // true then header redirect it to the home page directly 
    {
        header("Location:home.php"); 
    }

    if(isset($_POST['loginin']))   // it checks whether the user clicked login button or not 
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
         //search
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($connection, $sql) or die("Failed to query database ".mysqli_error($connection));
        //compare
        $row = mysqli_fetch_array($result);
        if (($row['email'] == $email) && ($row['password'] == $password)){
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['UserName'] = $row['firstname']." ".$row['lastname'];
            $_SESSION['UserLoggedIn'] = true;

            header("Location: home.php?welcome");
        } else {
            header("Location: login.php?Error");
            die();
        }
        
    }

?>

