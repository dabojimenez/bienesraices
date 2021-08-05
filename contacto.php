<?php 

    require 'includes/app.php';

    includeTemplate('header');
    
?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>
        
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario" action="">
            <fieldset>
                <legend>Informaicon personal</legend>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" placeholder="Tu Nombre">

                <label for="email">E-mail:</label>
                <input type="email" id="email" placeholder="Tu E-mail">

                <label for="telefono">Telefono:</label>
                <input type="tel" id="telefono" placeholder="Tu Telefono">

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre Propiedad</legend>

                <label for="opciones">Vende o Compra:</label>
                <select name="" id="opciones">
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="Compra">Compra</option>
                    <option value="Venta">Venta</option>
                </select>

                <label for="precio">Precio o Presipuesto:</label>
                <input type="number" id="precio" placeholder="Tu Precio o Presupuesto">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <p>Como desea ser contactado</p>

                <div>
                    <label for="contactar-telefono">Telefono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono">
                    <label for="contactar-telefono">E-mail</label>
                    <input name="contacto" type="radio" value="email" id="contactar-telefono">
                </div>

                <p>Si eligio telefono, elija la fecha y la hora</p>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" >

                <label for="hora">Hora:</label>
                <input type="time" id="hora" min="09:00" max="18:00">
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>

<?php includeTemplate('footer'); ?>