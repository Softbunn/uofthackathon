<?php
require('functions.php');
if(checkEmail($_POST["email"], "Clients")){
    apologize("Email is already taken!");
} else{
    registerClient($_POST["email"], $_POST["password"], $_POST["first"]." ".$_POST["last"]);
    session_start();
    $_SESSION["email"] = $_POST["email"];
    redirect("categories.php");
}
