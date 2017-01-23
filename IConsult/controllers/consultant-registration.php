<?php
require('functions.php');
if(checkEmail($_POST["email"], "Consultants")){
    apologize("Email is already taken!");
} else{
    $email = $_POST["email"];
    $password = $_POST["password"];
    $name = $_POST["first"].' '.$_POST["last"];
    $years = $_POST["years"];
    $language = $_POST["language"];
    $clients = $_POST["clients"];
    $summary = $_POST["summary"];
    $category = $_POST["category"];
    registerConsultantProfile($email, $name, $years, $language, $clients, $summary, $category);
    $consultant = getConsultant($email);
    $id = $consultant["id"];
    registerConsultantEntry($id, $password);
    session_start();
    $_SESSION["id"] = $id;
    redirect('profile.php');
}