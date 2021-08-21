<?php
require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

$vendedor = new Vendedor;
// Arreglo con mensaje de errores
$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear nueva instancia
    $vendedor = new Vendedor($_POST['vendedor']);
    // Validar que no existan campos vacios
    $errores = $vendedor->validar();
    // No hay errores
    if (empty($errores)) {
        $vendedor->guardar();
    }
}

includeTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1>
    <a href="/BienesRaices/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <form action="/BienesRaices/admin/vendedores/crear.php" method="POST" class="formulario" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
    </form>

</main>

<?php includeTemplate('footer'); ?>