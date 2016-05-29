<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Consultar stock</title>
    <link rel="stylesheet" type="text/css" href="../../static/css/styles.css">
</head>
<body>
<?php include '../../servicios/bd.php';?>
<?php include '../../servicios/stock.php';?>
<?php include '../../servicios/almacenes.php';?>
<?php include '../../servicios/productos.php';?>

<div class="container">
    <h1 class="page-header col-md-12">Consultar stock</h1>
    <?php
    if (isset($_GET['mensaje'])) {
        echo $_GET['mensaje'];
    }
    ?>
    <table id="stock" class="table">
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
<div id="back" class="col-md-pull-6 derecha"><a href="../home/home.php">volver</a> </div>
<script type="text/javascript" src="../../static/js/comun.js"></script>
</body>
</html>