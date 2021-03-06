<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Registrar proveedor</title>
    <link rel="stylesheet" type="text/css" href="../../static/css/styles.css">
</head>
<body>
<h1 class="page-header col-md-12">NUEVO PROVEEDOR</h1>
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
    <form method="post" action="nuevo.php" onsubmit="return validaDni()" enctype="multipart/form-data">
        <label id="label_nif" for="nif">NIF:</label>
        <input class="inputSelect" type="text" name="nif" id="nif" maxlength="9" value="<?php echo $nif; ?>">
        <?php echo $errorNif; ?>
        <label id="label_nombre" for="nombre">Nombre:</label>
        <input  class="inputSelect" type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
        <label id="label_telefono" for="telefono">Teléfono:</label>
        <input class="inputSelect" type="text" name="telefono" id="telefono" value="<?php echo $telefono; ?>"><br>
        <span id="errorDni"></span>
        <div id="divSubmit">
            <input class="button" id="submit" type="submit" value="Enviar">
        </div>
    </form>
</div>
<div id="back" class="col-md-pull-6 derecha"><a href="../home/home.php">volver</a> </div>
<script type="text/javascript" src="../../static/js/comun.js"></script>
</body>
</html>