<?php

require 'includes/app.php';

includeTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Anuncios</h1>
    <section class="seccion contenedor">
        <h2>Casas y Departamentos en Venta</h2>

        <?php
        $limite = 9;

        include 'includes/templates/anuncios.php';
        ?>

    </section>
</main>

<?php includeTemplate('footer'); ?>