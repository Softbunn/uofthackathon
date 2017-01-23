<?php

    /*
     * Helper functions.
     */

    /**
     * Apologizes to user with message.
     */
    function apologize($message)
    {
        render("apology.php", ["message" => $message]);
        exit;
    }

    /**
     * Facilitates debugging by dumping contents of variable
     * to browser.
     */
    function dump($variable)
    {
        require("../templates/dump.php");
        exit;
    }
    /**
     * Logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     */
    function logout()
    {
        // unset any session variables
        $_SESSION = [];

        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();
    }
    /**
     * Redirects user to destination, which can be
     * a URL or a relative path on the local host.
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     **/
    function redirect($destination)
    {
        // handle URL
        if (preg_match("/^https?:\/\//", $destination))
        {
            header("Location: " . $destination);
        }

        // handle absolute path
        else if (preg_match("/^\//", $destination))
        {
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            header("Location: $protocol://$host$destination");
        }

        // handle relative path
        else
        {
            // adapted from http://www.php.net/header
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: $protocol://$host$path/$destination");
        }

        // exit immediately since we're redirecting anyway
        exit;
    }

    /**
     * Renders template, passing in values.
     */
     function render($template, $values = [])
    {
        // if template exists, render it
        if (file_exists("../templates/$template"))
        {
            // extract variables into local scope
            extract($values);
            // render header
            require("../templates/header.php");

            // render template
            require("../templates/$template");

            // render footer
            if($template == "login-form.php" or empty($_SESSION["email"]) or check($_SESSION["email"], "Account")){
                require("../templates/footer.php");
            }
            else{
                require("../templates/footer.php");
            }
        }

        // else err
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }
    
   
    function connect(){
            	$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "iConsult";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
		} 
                $conn->close();
        }
    function query($statement){
                $servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "iConsult";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = $statement;
		if ($conn->query($sql) === TRUE) {
                    //echo "Query Successful";
		} else {
                    "Error updating record: " . $conn->error;
		}
                $conn->close();
	}
    function submitInvite($id, $email, $date, $message){
        query("INSERT INTO Invitations (id, email, date, message) VALUES ('$id', '$email', '$date', '$message')");
    }
    function checkEmail($email, $table){
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "iConsult";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $sql = "SELECT email FROM $table WHERE email = '$email'";
                $result = $conn->query($sql);
                $conn->close();
                if($result->num_rows == 0) {
                // row not found
                    return FALSE;
                } else {
                    return TRUE;
                }
        }
    function profile($id){
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "iConsult";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM Consultants WHERE id = $id";
                $result = $conn->query($sql);
                
                $row = $result->fetch_assoc();
                return $row;
        }
    //Call to get the information for all verified consultants
    function getConsultants($category){
        #Returns consultants in category <category>
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "iConsult";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM Consultants WHERE category = '$category'";
                $result = $conn->query($sql);
                return $result;
    }
    function getConsultant($email){
        #Returns consultant with email <email>
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "iConsult";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM Consultants WHERE email = '$email'";
                $result = $conn->query($sql);
                
                $row = $result->fetch_assoc();
                return $row;
        }
    function verify($address, $pass, $table){
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "iConsult";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $sql = "SELECT * FROM $table WHERE email = '$address'";
                $result = $conn->query($sql);
                $conn->close();
                if($result->num_rows == 0) {
                // row not found
                    return FALSE;
                } elseif ($result->fetch_assoc()["password"] != $pass) {
                    return FALSE;
                } else {
                    return TRUE;
                }
        }
        function verifyConsultant($id, $pass, $table){
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "iConsult";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $sql = "SELECT * FROM $table WHERE id = '$id'";
                $result = $conn->query($sql);
                $conn->close();
                if($result->num_rows == 0) {
                // row not found
                    return FALSE;
                } elseif ($result->fetch_assoc()["pass"] != $pass) {
                    return FALSE;
                } else {
                    return TRUE;
                }
        }
    function change_pic($id, $picture){
                query("UPDATE Consultants
                       SET image='$picture'
                       WHERE id='$id'");
        }
    function confirm($email){
            require '../mailer/PHPMailerAutoload.php';

            $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com;smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'amrmagdy.sharaf@gmail.com';                 // SMTP username
            $mail->Password = 'redamroz';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('blackboardlearn@gmail.com');
            $mail->addAddress($email);     // Add a recipient
            #$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('info@example.com', 'Information');

                #$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                #$mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Confirmation';
            $mail->Body    = 'Thank you for joining our powerful community. Please go to '. 
                             'http://localhost:8888/register.php?email='.explode("@",$_SESSION["email"])[0].
                             '%40mail.utoronto.ca'.
                             ' to continue with the registration process.';
            #$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }

        }
    function notify($receiver, $subject, $body, $sender){
            require '../mailer/PHPMailerAutoload.php';

            $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com;smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'amrmagdy.sharaf@gmail.com';                 // SMTP username
            $mail->Password = 'redamroz';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('blackboardlearn@gmail.com');
            $mail->addAddress($receiver);     // Add a recipient
            #$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('info@example.com', 'Information');

                #$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                #$mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Confirmation';
            $mail->Body    = "This email is sent by: ".$sender."\n"
                    . "Subject: $subject \n". "$body";
            #$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }

        }
    function get_matches($table, $column, $value){
                /* Returns the rows in table where coloumn is equal to value
                 * Used in search-results.php to get matches for input search.
                 * The returned value must be fetched in a loop as following
                 * while($row = $my_projects->fetch_assoc())
                 * $row is a dictionairy with keys as columns.
                 * 
                 */
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "iConsult";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT *
                        FROM $table
                        WHERE $column LIKE '%$value%'";
                $result = $conn->query($sql);
                return $result;
    }
    function registerClient($email, $pass, $name){
                query("INSERT INTO Clients (email, password, name, points)
                    VALUES ('$email', '$pass', '$name', '0')");
    }
    function registerConsultantProfile($email,
            $name, $years, $language, $clients, $summary, $category){
        query("INSERT INTO Consultants (name, email, years, language, clients, summary, category)
                    VALUES ('$name', '$email', '$years', '$language', '$clients', '$summary', '$category')");
    }
    function registerConsultantEntry($id, $password){
                query("INSERT INTO ConsultantsID (id, pass)
                    VALUES ('$id', '$password')");
    }
    /***
     * Gets invitation info
     * "date"
     * "email"
     * "id"
     * "message"
     */
    function getInvitations($id){
        #Returns invitations for id <id>
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "iConsult";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM Invitations WHERE id = '$id'";
                $result = $conn->query($sql);
                return $result;
    }
    function getClient($email){
        #Returns client with email <email>
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "iConsult";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM Clients WHERE email = '$email'";
                $result = $conn->query($sql);
                
                $row = $result->fetch_assoc();
                return $row;
    }
    function updatePoints($email, $points){
        $client = getClient($email);
        $new_points = $client["points"] + $points;
        query("UPDATE Clients
       SET points='$new_points'
       WHERE email='$email'");
    }
    function updateLink($email, $link){
        query("UPDATE Clients
       SET link='$link'
       WHERE email='$email'");
    }
?>
