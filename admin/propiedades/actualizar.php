<?php

use App\Propiedad;
use App\Vendedor;

use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';
estaAutenticado();

//  Validamos que sea un id valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /BienesRaices/admin');
}


//  OBtener los datos de la propiedad
$propiedad = Propiedad::find($id);

//Consultar par aobtener vendedores
$vendedores = Vendedor::all();

//Arreglo con mensajes de errores
$errores = Propiedad::getErrores();

//Ejecutar el codigo depsues de que el usuario envia el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Asignar los atributos
    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args);

    // NOmbre de la imagen
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    // Subida de archivos
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        // debugear('Cambio de imagen');
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    // Validar
    $errores = $propiedad->validar();

    // Ejecutamos el codigo despues de que el usuario envie el formulario
    if (empty($errores)) {
        // ALmacenar la imagen
        if ($_FILES['propiedad']['tmp_name']['imagen']) {
            $image->save(CARPETA_IMAGENES . $nombreImagen);
        }
        
        $propiedad->guardar();
    }
}

includeTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    <a href="/BienesRaices/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <form method="POST" class="formulario" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>

</main>

<?php includeTemplate('footer'); ?>