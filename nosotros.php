<?php 

    require 'includes/app.php';

    includeTemplate('header');
    
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>
            <div>
                <section class="texto-nosotros">
                    <blockquote>
                        25 Años de Experiencia
                    </blockquote>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus odit, ullam incidunt omnis
                        cumque, facere at iure provident dolorum inventore dignissimos consequatur praesentium, unde
                        corporis exercitationem quia illo totam. Quis?</p>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab sapiente ut, beatae in illo numquam,
                        corrupti necessitatibus mollitia, delectus tenetur quibusdam odio esse! Consequatur a ratione
                        facere nesciunt aliquid aperiam.</p>
                </section>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más sobre nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>seguridad</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad molestiae debitis unde, aspernatur
                    aliquam impedit hic iusto, rem totam labore porro! At, labore. Hic ratione vel quaerat dolore
                    autem culpa.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad molestiae debitis unde, aspernatur
                    aliquam impedit hic iusto, rem totam labore porro! At, labore. Hic ratione vel quaerat dolore
                    autem culpa.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad molestiae debitis unde, aspernatur
                    aliquam impedit hic iusto, rem totam labore porro! At, labore. Hic ratione vel quaerat dolore
                    autem culpa.</p>
            </div>
        </div>
    </section>

<?php includeTemplate('footer'); ?>