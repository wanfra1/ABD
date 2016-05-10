<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Crear venta</title>
    <link rel="stylesheet" type="text/css" href="../../static/css/styles.css">
</head>
<body>
<h1 class="page-header col-md-12">NUEVA VENTA</h1>
<?php include '../../servicios/bd.php';?>
<?php include '../../servicios/ventas.php';?>
<?php include '../../servicios/almacenes.php';?>
<?php include '../../servicios/productos.php';?>

<div id="listaVentas">
    <?php
        if (isset($_GET['mensaje'])) {
            echo $_GET['mensaje'];
        }
    ?>
        <table id="ventas">
            <tr>
                <th>ID</th>
                <th>Descripcion</th>
                <th>Acciones</th>
            </tr>
            <?php
                $ventas = new Ventas();
                $todos = $ventas->todos();
                foreach ($todos as $todo) {
                    echo '<tr><td>'.$todo[0].'</td><td>'.$todo[2].'</td><td><form method="post" action="eliminar.php"><input type="hidden" name="id" value="'.$todo[0].'"><input type="submit" name="eliminar" value="Eliminar"></form></td></tr>';
                }
            ?>
        </table>
</div>
<div id="back" class="col-md-pull-6 derecha"><a href="../home/home.php">volver</a> </div>
<script type="text/javascript" src="../../static/js/comun.js"></script>
</body>
</html>