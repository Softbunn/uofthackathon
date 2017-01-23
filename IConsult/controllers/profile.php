<?php
require('functions.php');
session_start();
if(empty($_SESSION["id"])){
    redirect('index.php');
} else{
    render("consultant-form.php", ["title" => "Welcome back!", "id" => $_SESSION["id"]]);
}

