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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //  Obtenemos el valor de nuestra variable
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        //  Eliminar el archivo
        $queryImagen = "SELECT imagen FROM propiedades WHERE id = ${id}";
        $resultado = mysqli_query($db, $queryImagen);
        $propiedadImagen = mysqli_fetch_assoc($resultado);
        //  ELiminamos el archivo con (unlink)
        $test = unlink('../imagenes/' . $propiedadImagen['imagen']);
        // if ( $test ) {
        //     echo 'elimino la imagen';
        // }else{
        //     echo 'no se eliminamo la imagen';
        // }

        //  ELiminar la Propiedad
        $query = "DELETE FROM propiedades WHERE id = ${id}";

        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            header('Location:/BienesRaices/admin?resultado=3');
        }
    }
}

//  INcluye Template
includeTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Administradro de Bienes Raicess</h1>
    <?php if (intval($resultado) === 1) :  ?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php elseif (intval($resultado) === 2) : ?>
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
    <?php elseif (intval($resultado) === 3) : ?>
        <p class="alerta exito">Anuncio Eliminado Correctamente</p>
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
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) :  ?>
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td> <img src="/BienesRaices/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad['precio']; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <!-- el type (hidden), quiere decir que esta oculto, y en este caso ocultaremos el ID -->
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>

                        <a href="propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
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