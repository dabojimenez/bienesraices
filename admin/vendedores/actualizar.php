<?php
require '../../includes/app.php';
use App\Vendedor;
estaAutenticado();

// Validar que el id, sea valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /BienesRaices/admin');
}

// OBtener el arreglo del vendedor
$vendedor = Vendedor::find($id);
// Arreglo con mensaje de errores
$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asignar los valores
    $args = $_POST['vendedor'];
    // Sincronizar objeto en memoria ocn lo escrito por el usuario
    $vendedor->sincronizar($args);
    // Validar
    $errores = $vendedor->validar();
    if (empty($errores)) {
        $vendedor->guardar();
    }
}

includeTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Vendedor(a)</h1>
    <a href="/BienesRaices/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <form method="POST" class="formulario">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Guardar Cambios" class="boton boton-verde">
    </form>

</main>

<?php includeTemplate('footer'); ?>