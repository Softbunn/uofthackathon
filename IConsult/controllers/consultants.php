<?php
require("functions.php");
session_start();
if(empty($_SESSION["email"])){
    redirect('index.php');
} else{
    $consultants = getConsultants($_GET["category"]);
    render("consultants-form.php", ["consultants" => $consultants]);
}