<?php
session_start();
unset($_SESSION["UserLoggedIn"]);
unset($_SESSION["id"]);
unset($_SESSION["email"]);
header("Location:login.php");
?>