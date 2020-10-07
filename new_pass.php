<?php
include('database.php');
if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"])
    && ($_GET["action"]=="reset") && !isset($_POST["action"])){
    $key = $_GET["key"];
    echo $key;
    $email = $_GET["email"];
    $curDate = date("Y-m-d H:i:s");
    $error=null;
    $query = mysqli_query($conexionMySQLi,
        "SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';"
    );
    $row = mysqli_num_rows($query);
    if ($row==""){
        $error .= '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link
from the email, or you have already used the key in which case it is 
deactivated.</p>
<p><a href="192.168.0.17/login/enter_email.php">
Click here</a> to reset password.</p>';
    }else{
        $row = mysqli_fetch_assoc($query);
        $expDate = $row['expDate'];
        if ($expDate >= $curDate){
            ?>
            <br />
            </form>
            <form method="POST" action="" name="update">
                <input type="hidden" name="action" value="update" />
                <br /><br />
                <label>New password</label>
                <input type="password" name="pass1" id="pass1" placeholder="Enter your new password">
                <label for="email">Confirm new password</label>
                <input type="password" name="pass2" id="pass2" placeholder="Enter your new password">
                <input type="hidden" name="email" value="<?php echo $email;?>"/>
                <input type="submit" name="Reset Password" value="Submit">
            </form>
            <?php
        }else{
            $error .= "<h2>Link Expired</h2>
<p>The link is expired. You are trying to use the expired link which 
as valid only 24 hours (1 days after request).<br /><br /></p>";
        }
    }
    if($error!=""){
        echo "<div class='error'>".$error."</div><br />";
    }
} // isset email key validate end


if(isset($_POST["email"]) && isset($_POST["action"]) &&
    ($_POST["action"]=="update")){
    $error="";
    $pass1 = mysqli_real_escape_string($conexionMySQLi,$_POST["pass1"]);
    $pass2 = mysqli_real_escape_string($conexionMySQLi,$_POST["pass2"]);
    $email = $_POST["email"];
    $curDate = date("Y-m-d H:i:s");
    if ($pass1!=$pass2){
        $error.= "<p>Password do not match, both password should be same.<br /><br /></p>";
    }
    if($error!=""){
        echo "<div class='bad'>".$error."</div><br />";
    }else{
        $pass1 = md5($pass1);
        mysqli_query($conexionMySQLi,
            "UPDATE `login` SET `password`='".$pass1."' WHERE `email`='".$email."';"
        );

        mysqli_query($conexionMySQLi,"DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");

        echo '<div class="bad"><p>Congratulations! Your password has been updated successfully.</p>
<p><a href="192.168.0.17/login/index.php">
Click here</a> to Login.</p></div><br />';
    }
}
?>



<!--<!DOCTYPE html>
<html>
<head>

    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' href='css/styles.css'>
    <script src='main.js'></script>
</head>
<body>
<div class="login">
    <img class="logo" src="Imagenes/logo efecto.png" alt="Fondo">
    <h1>New password</h1>
    <form method="POST">

        <label for="email">New password</label>
        <input type="password" name="new_pass_c" id="new_pass" placeholder="Enter your new password">
        <label for="email">Confirm new password</label>
        <input type="password" name="new_pass_c" id="new_pass_c" placeholder="Enter your new password">
        <input type="submit" name="new_password" value="Submit">
    </form>

</div>
</body>
</html>-->