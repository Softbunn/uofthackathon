<?php
require('../controllers/functions.php');
$email = $_GET["email"];
?>
<html>
    <head>
        <link rel="stylesheet" href="iframe.css">
        <script src="../js/javascript.js"></script>
    </head>
    <body>
        <iframe src="https://appr.tc/" onload="this.width=screen.width*0.7;this.height=screen.height*0.7;"></iframe>
        <div class="link">
            <label class="linkLabel">Please send the link to the client!</label><br>
        <input type="text" value="" id="message">
        <button id="sendLinkButton" onclick="session(<?php echo($email); ?>)>">Send</button>
        </div>
        <div id="chat">
            
        </div>
    </body>
</html>
