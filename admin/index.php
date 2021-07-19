<?php

    //  Importar la conexion
    require '../includes/config/database.php';
    $db = coneccionBD();

    //  Escribimos el QUery
    $query = "SELECT * FROM propiedades";

    //  Consultar la base de datos
    $resultadoConsulta = mysqli_query($db, $query);


    //  Muestra mensjae condicional
    // Con (??), podemos asignar a la URL un valor null
    $resultado = $_GET['resultado'] ?? null;
    require '../includes/funciones.php';

    //  INcluye Template
    includeTemplate('header');
    
?>

    <main class="contenedor seccion">
        <h1>Administradro de Bienes Raicess</h1>
        <?php if (intval($resultado) === 1):  ?>
            <p class="alerta exito">Anuncio creado correctamente</p>
        <?php endif; ?>
        <a href="propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tutulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tbody>
                <!-- Mostrar los resultados -->
                <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)):  ?>
                <tr>
                    <td><?php echo $propiedad['id'];?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td> <img src="/BienesRaices/imagenes/<?php echo $propiedad['imagen'];?>" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad['precio']; ?></td>
                    <td>
                        <a href="#" class="boton-rojo-block" >Eliminar</a>
                        <a href="#" class="boton-amarillo-block" >Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
    </main>

<?php
    //  Cerramos la conexion de la base de datos
    mysqli_close($db);

includeTemplate('footer'); ?>