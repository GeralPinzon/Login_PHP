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
        <h1>Login</h1>
        <form method="POST">
            <!--Username-->
            <label for="username">Username</label>
            <input type="text" name="nombre" id="nombre" placeholder="Enter Username">
            <!--Password-->
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter Password">
            <input type="submit" value="Log In" name="enviar">
            <a href="recoverpassword.php">Lost your password?</a>
        </form>
        <?php include ("validate.php");?>
    </div>
</body>
</html>