<?php
include('database.php');
if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $error = null;

    if (!$email) {
        $error = "<p> Invalid email address please type a valid email address!</p>";
    } else {
        $query = "SELECT * FROM login WHERE Correo = '$email'";
        $results = mysqli_query($conexionMySQLi, $query);
        $row = mysqli_num_rows($results);
        if ($row == null) {
            $error = "<p>No user is registered with this email address!<br>  </p>";
        }

    }
    if ($error != null) {
        echo "<div class='error'>" . $error . "</div>
       <br /><a href='javascript:history.go(-1)'>Go Back</a>";
    } else {
        $expFormat = mktime(
            date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y")
        );
        $expDate = date("Y-m-d H:i:s", $expFormat);
        $key = md5(2418 * 2 + $email);
        $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
        $key = $key . $addKey;
        // Insert Temp Table
        $query_insertDB = "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
    VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');";

        mysqli_query($conexionMySQLi, $query_insertDB);

        $output = '<p>Dear user,</p>';
        $output .= '<p>Please click on the following link to reset your password.</p>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= '<p><a href="192.168.0.17/login/reset-password.php?
    key=' . $key . '&email=' . $email . '&action=reset" target="_blank">
    192.168.0.17/login/reset-password.php
    ?key=' . $key . '&email=' . $email . '&action=reset</a></p>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= '<p>Please be sure to copy the entire link into your browser.
    The link will expire after 1 day for security reason.</p>';
        $output .= '<p>If you did not request this forgotten password email, no action 
    is needed, your password will not be reset. However, you may want to log into 
    your account and change your security password as someone may have guessed it.</p>';
        $output .= '<p>Thanks,</p>';
        $output .= '<p>AppEnd Team</p>';
        $body = $output;
        $subject = "Password Recovery ";
        $email_to = $email;
        $fromserver = "geraldinpinzon04@gmail.com";
        require("PHPMailer/PHPMailerAutoload.php");
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "192.168.0.17"; // Enter your host here
        $mail->SMTPAuth = true;
        $mail->Username = "geraldinpinzon04@gmail.com"; // Enter your email here
        $mail->Password = "geral29pinzon"; //Enter your password here
        $mail->Port = 25;
        $mail->IsHTML(true);
        $mail->From = "geraldinpinzon04@gmail.com";
        $mail->FromName = "AppEnd";
        $mail->Sender = $fromserver; // indicates ReturnPath header
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($email_to);
        if(!$mail->Sender()){
            echo "Mailer Error: " .$mail->ErrorInfo;
        }else{
            echo "<div class='bad'>
                <p>An email has been sent to you with instructions on how to reset your password.</p>
                </div><br /><br /><br />";
        }
        /*
        if (!$mail->Send()) {

            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            print ' Emntree';
            print 'An email has been sent to you with instructions on how to reset your password.';
        }*/
    }
} else {
    ?>
    <form method="post" action="" name="reset"><br/><br/>
        <label><strong>Enter Your Email Address:</strong></label><br/><br/>
        <input type="email" name="email" placeholder="username@email.com"/>
        <br/><br/>
        <input type="submit" value="Reset Password"/>
    </form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
<?php } ?>  

