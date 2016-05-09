<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Crear venta</title>
</head>
<body>
<h1>Nueva venta</h1>
<?php include '../../servicios/bd.php';?>
<?php include '../../servicios/ventas.php';?>
<?php include '../../servicios/almacenes.php';?>
<?php include '../../servicios/productos.php';?>

<div id="listaVentas">
    <form method="post" action="eliminar.php" enctype="multipart/form-data">
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
                    echo '<tr><td>'.$todo[0].'</td><td>'.$todo[2].'</td><td><input type="submit" name="eliminar" value="Eliminar"><a href="ver.php?id='.$todo[0].'">Ver</a></td></tr>';
                }
            ?>
        </table>
    </form>
</div>
<script type="text/javascript" src="../../static/js/comun.js"></script>
</body>
</html>