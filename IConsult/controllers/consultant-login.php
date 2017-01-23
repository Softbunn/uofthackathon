<?php
require('functions.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(verifyConsultant($_POST["id"], $_POST["password"], "ConsultantsID")){
        session_start();
        $_SESSION["id"] = $_POST["id"];
        redirect("profile.php");
    } else{
        apologize("Wrong id or password");
    }
} else{
    render("consultant-login-form.html", ["title" => "Login"]);
}