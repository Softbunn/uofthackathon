<?php
require('../controllers/functions.php');
session_start();
//This is the profile page for each consultant
$id = $_POST["id"];
$consultant = profile($id);
if(empty($consultant["image"])){
    $image = "Lawyer.jpg";
} else{
    $image = $consultant["image"];
}
?>
<div id="content" class="container-fluid">
        <h1><?php echo($consultant["name"])?></h1>
        <img class="profile_pic" src="../images/<?php echo($image); ?>" alt="Profile Picture">
        <a class="profile_text">
        <p><b>Summary: <?php echo($consultant["summary"])?></b></p>
        <p>Years of experience: <?php echo($consultant["years"])?></p>
        <p>Clients: <?php echo($consultant["clients"])?></p>
        <p>LinkedIn profile: <?php echo($consultant["email"])?></p>
        </a>
        <br>
        <p id="contact"><b>If you would like to contact this consultant, fill out the form below:</b></p>
        <div id="form">
                <p class="prompt">Date of appointment:
                    <input id="date" type="text" name="subject" placeholder="Monday 15th at 9 am">
                </p>
                <p class="prompt">Message:</p>
                <textarea id="message" rows="20" cols="50"></textarea>
                <button type="submit" onclick="inviteConsultant(<?php echo $consultant["id"]; ?>, '<?php echo($_SESSION["email"]); ?>')">Submit</button>
        </div>

</div>