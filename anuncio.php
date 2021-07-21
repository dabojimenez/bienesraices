<?php

require 'includes/funciones.php';
includeTemplate('header');
//  OBtener valor de la URL mediante GET
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /BienesRaices/anuncios.php');
}

//  Importamos la conexion
require 'includes/config/database.php';
$db = coneccionBD();

//  Consulta a BD
$query = "SELECT * FROM propiedades WHERE id = ${id}";

//  Obtener resultados
$consulta = mysqli_query($db, $query);
if (!$consulta->num_rows) {
    header('Location: /BienesRaices/');
}
$propiedad = mysqli_fetch_assoc($consulta);
?>

<main class="contenedor seccion contenido-centrado">
    <h1> <?php echo $propiedad['titulo']; ?> </h1>

    <img loading="lazy" src="imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imagen de la propiedad">

    <div class="reumen-propiedad">
        <p class="precio">$<?php echo $propiedad['precio']; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad['wc']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad['estacionamiento']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                <p><?php echo $propiedad['habitaciones']; ?></p>
            </li>
        </ul>

        <p><?php echo $propiedad['descripcion']; ?></p>

    </div>

</main>

<?php
//  Cerramos la conexion
mysqli_close($db);
includeTemplate('footer'); ?>