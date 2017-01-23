<?php
require('functions.php');
session_start();
$client = getClient($_POST["email"]);
updatePoints($client["email"], ($_POST["points"]/5));
redirect("categories.php");