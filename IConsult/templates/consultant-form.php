        <?php
            $consultant = profile($id);
            if(empty($consultant["image"])){
                $image="Lawyer.jpg";
            } else{
                $image = $consultant["image"];
            }
        ?>
        <h1 class="info">Name: <?php echo $consultant["name"]; ?></h1>
        <div class="field">
            <img class="profile_pic"src="../images/<?php echo $image ?>" alt="Profile Pic">
            <h2 class="info">Field: <?php echo $consultant["category"]; ?></h2>
            <h3 class="info">Summary: <?php echo $consultant["summary"]; ?></h3>
            <h4 class="info">Company: <?php echo $consultant["company"]; ?></h4>
            <h4 class="info">Years of experience: <?php echo $consultant["years"]; ?></h4>
            <h4 class="info">Number of previous clients: <?php echo $consultant["clients"]; ?></h4>
            <a class="info"> Contact info: <?php echo $consultant["email"]; ?></a>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input class="newButtons" type="file" name="fileToUpload" id="fileToUpload"><br>
                <input class="newButtons" type="submit" value="Change DP" name="submit">
            </form>
        </div>
        <div class="newButtons">
        </div>
            Appointments:
            <dl class="invitations">
        <?php
           $invitations = getInvitations($id);
            while($row = $invitations->fetch_assoc()){
                $client = getClient($row["email"]);
                echo("<dt><fieldset class='invitation'>"
                        . "<p>You have an appointment on ".$row["date"]
                        . " with ".$client["name"]
                        . ". They left the message: ".$row["message"] 
                        . ".<br>To activate the session, please click the button activate."
                        . "</p><a href='../templates/session.php?email=".$client["email"]."'>Activate</a>"
                        . "</fieldset></dt>"
             );
         }
        ?>
            </dl>
        