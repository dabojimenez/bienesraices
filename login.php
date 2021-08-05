<?php
require 'includes/app.php';

//  IMportar conexion
// require ('includes/config/database.php');
$db = coneccionBD();


//  Autenticar el Usuario
$errores = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //var_dump($_POST);

    $email = mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL));
    //var_dump($email);
    $password =mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = "El email es Obligatorio o no es válido";
    }

    if (!$password) {
        $errores[] = "El Password es obligatorio";
    }

    if (empty($errores)) {
        //  Revisar si un Usuario Existe
        $query = "SELECT * FROM usuarios WHERE email = '${email}'";
        $resultado = mysqli_query($db,$query);
        


        if ($resultado->num_rows) {//   Comprobamos si tiene resultados en la consulta
            # Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);

            //  Verificar si el password es corrrecto o no
            //  para esto usmaos (password_verify), le pasamos el password en string y el segundo es el password hasheado
            $autenticacion = password_verify($password, $usuario['password']);
            if ($autenticacion) {
                #   El usuario esta autenticado
                //  Aremos uso de (session_start), para iniciar la session y asi poder acceder a ($_SESSION)
                session_start();

                //  Llenar el arreglo de la sesión
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;
                // echo "<pre>";
                // var_dump($_SESSION);
                // echo "</pre>";

                header('Location: /BienesRaices/admin');
            }else{
                $errores[] = "El password es incorrecto";
            }
            //var_dump($autenticacion);
        }else{
            $errores[] = "El usuario no existe";
        }
    }

}

//  Incluye el header

includeTemplate('header');

?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" placeholder="Tu E-mail" require>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Tu Password" require>

        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>

<?php includeTemplate('footer'); ?>