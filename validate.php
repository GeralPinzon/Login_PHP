<?php
    session_start();
    error_reporting(5);
    require 'database.php';
    if (isset($_POST['enviar'])) {
        if(!empty($_POST['nombre']) && !empty($_POST['password'])){
            $records=$conexionMySQLi ->prepare('SELECT ID, login, clave FROM login WHERE login = :nombre');
            $records->bindParam(':nombre', $_POST['nombre']); /*vinncular valores*/ 
            $records->execute();/*ejecuto consulta*/
            $results = $records->fetch(PDO::FETCH_ASSOC); /*obtener datos usuario    */
            $message='';
			print $results['login'];
            if($results == true && $_POST['password']==$results['clave']){
                $_SESSION['user_id']=$results['id'];
                header('Locationn: /php-index');
                ?>
                    <h3 class="ok"> Exit!</h3>
                <?php
            }else{
                ?>
                    <h3 class="bad"> Sorry, those credentials do not match</h3>
                <?php
            }
        }else{
            ?>
                <h3 class="bad"> Please complete the fields!</h3>
            <?php
        }
    }
?>