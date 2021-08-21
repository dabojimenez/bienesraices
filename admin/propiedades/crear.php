<?php
require '../../includes/app.php';

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

$propiedad = new Propiedad();

// Consulta para obtener todos los vendedores
$vendedores = Vendedor::all();

$errores = Propiedad::getErrores();

//Ejecutar el codigo depsues de que el usuario envia el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /**Crear una nueva instanci */
    $propiedad = new Propiedad($_POST['propiedad']);

    $carpetaImagenes = '../../imagenes/';
    
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
    // Setear la imagen
    // Realiza un resize a la imagen con intervention
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
        $propiedad->setImagen($nombreImagen);
    }
    // Validar

    $errores = $propiedad->validar();

    if (empty($errores)) {

        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }

        $image->save(CARPETA_IMAGENES . $nombreImagen);
        $resultado = $propiedad->guardar();
        
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
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>

</main>

<?php includeTemplate('footer'); ?>