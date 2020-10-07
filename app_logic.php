<?php
include('database.php');
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('/usr/share/php/PHPMailer/PHPMailer6/PHPMailer.php');
require_once('/usr/share/php/PHPMailer/PHPMailer6/SMTP.php');
require_once('/usr/share/php/PHPMailer/PHPMailer6/Exception.php');
require_once('/usr/share/php/PHPMailer/PHPMailer6/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
$errors = null;
if (isset($_POST['reset-password'])) {
    if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
        $email = $_POST["email"];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);


        if (!$email) {
            $errors .= "<p> Invalid email address please type a valid email address!</p>";
        }else {
            $query = "SELECT * FROM login WHERE Correo = '$email'";
            $results = mysqli_query($conexionMySQLi, $query);
            $row = mysqli_num_rows($results);
            if ($row == null) {
                $errors .= "<p>No user is registered with this email address!<br>  </p>";
            }

        }
        if ($errors != null) {
            echo "<div class='error'>" . $errors . "</div>
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
            $query_insertDB = "INSERT INTO password_reset_temp (`email`, `key`, `expDate`)
            VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');";
            mysqli_query($conexionMySQLi,$query_insertDB);

            $output = '<p>Dear user,</p>';
            $output .= '<p>Please click on the following link to reset your password.</p>';
            $output .= '<p>-------------------------------------------------------------</p>';
            $output .= '<p><a href="192.168.0.17/login/new_pass.php?
    key=' . $key . '&email=' . $email . '&action=reset" target="_blank">
    192.168.0.17/login/new_pass.php
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
            $subject = "Password Recovery";
            $email_to = $email;
            $fromserver = "notificaciones.appendsolutions@gmail.com";

            $mail = new PHPMailer;
            $mail->IsSMTP();
           // $mail->SMTPDebug = 1;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = "smtp.gmail.com"; // Enter your host here
            $mail->SMTPAuth = true;
            $mail->Username = "notificaciones.appendsolutions@gmail.com"; // Enter your email here
            $mail->Password = "cmnatqucchuxgdsf"; //Enter your password here
            $mail->Port = 465;
            $mail->IsHTML(true);
            $mail->From = "notificaciones@appendweb.com";
            $mail->FromName = "AppEnd";
            $mail->Sender = $fromserver; // indicates ReturnPath header
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($email_to);
            if(!$mail->Send()){
                echo "Mailer Error: " . $mail->ErrorInfo;
            }else{
                echo "
                <p>An email has been sent to you with instructions on how to reset your password.</p>
                <br /><br /><br />";
            }
            /* Send email to user with the token in a link they can click on
            $to = $email;
            $subject = "Reset your password on examplesite.com";
            $msg = "Hi there, click on this <a href=\"new_pass.php?key=" . $key . "\">link</a> to reset your password on our site";
            $msg = wordwrap($msg, 70);
            $headers = "From: info@examplesite.com";
            mail($to, $subject, $msg, $headers);
            header('location: pending.php?email=' . $email);*/
        }
    }
}


