<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Registrar proveedor</title>
    <link rel="stylesheet" type="text/css" href="../../static/css/styles.css">
</head>
<body>
<h1>Nuevo proveedor</h1>
<?php include '../../servicios/bd.php';?>
<?php include '../../servicios/proveedores.php';?>
<?php
$conError = false;
$errorNif = '';
$nif = '';
$nombre = '';
$telefono = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['nif'])) {
        $errorNif = 'Por favor introduce el nif';
        $conError = true;
    } else {
        $nif = $_POST['nif'];
    }
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];

    if (!$conError) {
        $proveedores = new Proveedores();
        $proveedores->guardar($nif, $nombre, $telefono);
    }
}
?>

<div id="divForm">
    <form method="post" action="nuevo.php" enctype="multipart/form-data">
        <label id="label_nif" for="nif">NIF:</label>
        <input type="text" name="nif" id="nif" value="<?php echo $nif; ?>">
        <?php echo $errorNif; ?>
        <label id="label_nombre" for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
        <label id="label_telefono" for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" value="<?php echo $telefono; ?>">
        <div id="divSubmit">
            <button id="submit" type="submit">Enviar</button>
        </div>
    </form>
</div>
<script type="text/javascript" src="../../static/js/comun.js"></script>
</body>
</html>