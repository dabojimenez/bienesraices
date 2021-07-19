<?php 

    require 'includes/funciones.php';

    includeTemplate('header');
    
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoracion de tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="Imagen de la propiedad">
        </picture>

        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
        
        <div class="reumen-propiedad">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores, fuga velit. Similique mollitia soluta odit aperiam? Ullam ipsa assumenda libero amet accusantium! Voluptate enim rerum, illo repudiandae id porro. Impedit?</p>
        </div>

    </main>

<?php includeTemplate('footer'); ?>