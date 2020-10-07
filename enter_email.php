<!DOCTYPE html>
<html>
<head>
    <!-- Esttodo esto esta en recoverpassword -->
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
        <h1>Enter your email address to reset password</h1>
        <form method="POST">
            <!--Username-->
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email">
            <input type="submit" name="reset-password" value="Send">
        </form>
        <?php include('app_logic.php'); ?>
    </div>
</body>
</html>

