<?php
require 'includes/app.php';
use App\Propiedad;

//  OBtener valor de la URL mediante GET
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /BienesRaices/');
}

$propiedad = Propiedad::find($id);

includeTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1> <?php echo $propiedad->titulo; ?> </h1>

    <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen de la propiedad">

    <div class="reumen-propiedad">
        <p class="precio">$<?php echo $propiedad->precio; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>

        <p><?php echo $propiedad->descripcion; ?></p>

    </div>

</main>
<?php includeTemplate('footer'); ?>