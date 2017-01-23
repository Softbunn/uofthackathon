<?php
//$consultants should be received from the database
$client = getClient($_SESSION["email"]);
?>
<?php if(!empty($client["link"])){echo('<a class="paypalitem" href="'.$client["link"].'">'.$client["link"].'Click here to chat!'.'</a>');}?>
<a class="paypalitem" href="../templates/paypal.html">You have <?php echo($client["points"])?> points, click here to add points!</a>
<div class="page">
    <dl class="items">
        <?php
                    //<a href="page.php?value_key=some_value">Link</a>
                    //loop through each row return by fetch_assoc()
                    //print title and summary
                    while($row = $consultants->fetch_assoc()){
                        echo("<dt><button class='item' id='".$row["id"]."' onclick='hoverOverItem(this.id)'>".
                                $row["name"]
                                . "</button>"
                        );
                        echo(" (Rating: ".
                                $row["rating"]
                                ."/5)</dt>"
                        );
                    }
        ?>
    </dl>
    <!--<iframe class="profile" src="../templates/profile-form.php"></iframe>-->
    <fieldset class="profile" id="profile"></fieldset>
</div>
<a class="paypalitem" href="logout.php">Log out</a>