<?php
require '../../includes/funciones.php';
$autenticacion = estaAutenticado();
if (!$autenticacion) {
    header('Location: /BienesRaices/');
}


//BASE DE DATOS
require '../../includes/config/database.php';
$db = coneccionBD();
//Consultar par aobtener vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);
// if (!empty($resultado)) {
//     echo "<pre>";
//     var_dump($resultado);
//     echo "</pre>";
// }else {
//     echo 'ERROR EN LA CONSULTA';
// }
//var_dump($db);

// echo "<pre>";
// var_dump($_SERVER["REQUEST_METHOD"]);
// echo "</pre>";

//Arreglo con mensajes de errores
$errores = [];

//Capturar valores del formularion en variables
$titulo = '';
$precio = '';
//$imagen = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorid = '';

//Ejecutar el codigo depsues de que el usuario envia el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // //Las imagenes y los archivos se leen con la super global ($_FILES) y agregamos otro atributo a la etiquitea <form></form> llamado enctype="multipart/form-data"
    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";

    //Capturar valores del formularion en variables
    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio =mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion =mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones =mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc =mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento =mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorid =mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date('Y/m/d');

    //Asiganr files hacia una variable
    $imagen = $_FILES['imagen'];

    // var_dump($imagen);

    if (!$titulo) {
        $errores[] = "Debes añadir un Titulo";
    }

    if (!$precio) {
        $errores[] = "Debes añadir un Precio";
    }

    if (strlen($descripcion) < 50) {
        $errores[] = "Debes añadir una Descripcion y debetener almenos 50 caracteres";
    }

    if (!$habitaciones) {
        $errores[] = "Debes añadir Habitaciones";
    }

    if (!$wc) {
        $errores[] = "Debes añadir WC";
    }

    if (!$estacionamiento) {
        $errores[] = "Debes añadir Estacionamientos";
    }

    if (!$vendedorid) {
        $errores[] = "Elije un vendedor";
    }

    if (!$imagen['name'] || $imagen['error']) {
        $errores[] = 'La Imagen es Obligatoria';
    }

    //Validar por Tamaño (2Mb máximo)
    $medida = 1000 * 2000;

    if ($imagen['size'] > $medida) {
        $errores[] = 'La Imagen es muy pesada';
    }

    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";

    // exit;

    //Revisamos el array de errores este vacio
    if (empty($errores)) {
        // *****Subida de Archivos

        //Crear carpeta
        $carpetaImagenes = '../../imagenes/';
        //Verificamos si existe la carpeta, de no ser asi creamos la carpeta
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }
        
        //Generar un nombre único
        $nombreImagen = md5(uniqid( rand(), true )).".jpg";

        //Subir la imagen
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

        //Insertamos en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado,vendedorid)
    VALUES ('$titulo','$precio','$nombreImagen','$descripcion','$habitaciones','$wc','$estacionamiento','$creado','$vendedorid')";

        //echo $query;// Comprobamos si nuestro query, esta con la sintaxis correcta

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            // echo 'INSERTADO CORRECTAMENTE';
            //Redireccionamos al Usuario para evitar duplicidad de informacion
            //Esta funcion nos ayuda siempre y cuando no exista nada de HTML impreso, de lo contrario no es posible
            //Agregamos un QUERYSTRING en la URL, y lo hacemos mediante el uso de (?) y se deseamos mandar mas usamos (&)
            header('Location:/BienesRaices/admin?resultado=1');
        }
    }
}

includeTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/BienesRaices/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <form action="/BienesRaices/admin/propiedades/crear.php" method="POST" class="formulario" enctype="multipart/form-data"> 
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Porpiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Porpiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <label for="descripcion">Descripcion:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor" id="vendedor">
                <option value="">-- Seleccione --</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedorid===$vendedor['id'] ? 'selected': ''; ?> value="<?php echo $vendedor['id']; ?>"> <?php echo $vendedor['nombre'].' '.$vendedor['apellido']; ?></option>
                <?php endwhile ?>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>

</main>

<?php includeTemplate('footer'); ?>