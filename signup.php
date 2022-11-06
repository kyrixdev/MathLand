<?php
    session_start();
    require_once("connect.php");
    include_once("controllers/header.php");

    $fname= $_GET['fname'];
    $lname= $_GET['lname'];
    $email= $_GET['email'];
    $password= $_GET['password'];
    $phone= $_GET['phone'];
    $class= $_GET['class'];
    $is_active= 0;

    echo $fname, "<br>" ;
    echo $lname, "<br>";
    echo $email, "<br>";
    echo $password, "<br>";
    echo $phone, "<br>";
    echo $class, "<br>";
    echo $is_active;
    
    //Login Part 
    if(isset($_SESSION['UserLoggedIn']))   // Checking whether the session is already there or not if 
                                // true then header redirect it to the home page directly 
    {
        header("Location:home.php"); 
    }
    // Register Part
    $sqlUser = "SELECT * FROM users WHERE email = '".$email."'";
    $rs = mysqli_query($connection ,$sqlUser);
    $numUsers = mysqli_num_rows($rs);
    if($numUsers > 0) {
        header('location: register.php?UserExist');
    }else{
        $query= "INSERT INTO `users` (firstname, lastname, email, mobilenumber, password, is_active) VALUES ('$fname','$lname','$email','$phone','$password','$is_active')";
        if ($connection->query($query) === TRUE) {
            header('location: home.php');
        } else {
            echo "Error: " . $query . "<br>" . $connection->error;
        }
    }

?>

