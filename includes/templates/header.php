<?php 
if (!isset($_SESSION)) {
    session_start();
}
$autenticacion = $_SESSION['login'] ?? false ;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/BienesRaices/build/css/app.css">
</head>

<body>
    <!-- con (isset), verificamos si nuetsra variable esta inicializada-->
    <!-- <header class="header <?php echo isset($inicio) ? 'inicio' : ''; ?>" > -->
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/BienesRaices/admin/">
                    <img src="/BienesRaices/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/BienesRaices/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img src="/BienesRaices/build/img/dark-mode.svg" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a href="/BienesRaices/nosotros.php">Nosotros</a>
                        <a href="/BienesRaices/anuncios.php">Anuncios</a>
                        <a href="/BienesRaices/blog.php">Blog</a>
                        <a href="/BienesRaices/contacto.php">Contacto</a>
                        <?php if($autenticacion): ?>
                            <a href="/BienesRaices/cerrar-sesion.php">Cerrar Sesión</a>   
                        <?php endif;?>
                    </nav>
                </div>
            </div>
            <!-- Cierre de la barra -->
            <?php echo $inicio ? "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : '' ?>
        </div>
    </header>