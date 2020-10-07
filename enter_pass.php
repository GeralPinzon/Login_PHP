<!DOCTYPE html>
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
    <form method="POST" action="" name="update">
        <input type="hidden" name="action" value="update" />
        <br /><br />
        <label>New password</label>
        <input type="password" name="pass1" id="pass1" placeholder="Enter your new password">
        <label for="email">Confirm new password</label>
        <input type="password" name="pass2" id="pass2" placeholder="Enter your new password">
        <input type="hidden" name="email" value="<?php echo $email;?>"/>
        <input type="submit" value="Submit">
    </form>

</div>
</body>
</html>