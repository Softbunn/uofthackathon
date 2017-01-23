<?php
require('functions.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(verify($_POST["email"], $_POST["password"], "Clients")){
        session_start();
        $_SESSION["email"] = $_POST["email"];
        redirect("categories.php");
    } else{
        apologize("Wrong email or password");
    }
} else{
    render("client-login-form.html", ["title" => "Login"]);
}