<?php
require('functions.php');
echo('link sent');
$client = getClient($_POST["email"]);
$email = $client["email"];
updateLink($email, $link);