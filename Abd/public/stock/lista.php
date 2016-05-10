<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Consultar stock</title>
    <link rel="stylesheet" type="text/css" href="../../static/css/styles.css">
</head>
<body>
<h1>Consultar stock</h1>
<?php include '../../servicios/bd.php';?>
<?php include '../../servicios/stock.php';?>
<?php include '../../servicios/almacenes.php';?>
<?php include '../../servicios/productos.php';?>

<div id="listaStock">
    <?php
    if (isset($_GET['mensaje'])) {
        echo $_GET['mensaje'];
    }
    ?>
    <table id="stock">
        <tr>
            <th>Almacen</th>
            <th>Producto</th>
            <th>Categoría</th>
            <th>Unidades</th>
        </tr>
        <?php
        $stock = new Stock();
        $todos = $stock->todos();
        foreach ($todos as $todo) {
            echo '<tr><td>'.$todo[0].'</td><td>'.$todo[1].'</td><td>'.$todo[2].'</td><td>'.$todo[3].'</td></tr>';
        }
        ?>
    </table>
</div>
<script type="text/javascript" src="../../static/js/comun.js"></script>
</body>
</html>