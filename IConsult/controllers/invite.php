<?php
require('functions.php');
$id = $_POST["id"];
$email = $_POST["email"];
$message = $_POST["message"];
$date = $_POST["date"];
submitInvite($id, $email, $date, $message);
updatePoints($email, -10);
echo "Invitation sent!";