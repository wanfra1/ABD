<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Crear venta</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<?php include '../../servicios/bd.php';?>
<?php include '../../servicios/ventas.php';?>
<?php include '../../servicios/almacenes.php';?>
<?php include '../../servicios/productos.php';?>
<div class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Promotores Ana</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="lista.php">Ventas</a></li>
                <li><a href="#">Clientes</a></li>
                <li><a href="#">Productos</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../logout.php">Salir</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <h1 class="page-header col-md-12">Detalle de la venta</h1>
    <?php
        $ventas = new Ventas();
        $venta = null;
        $porReferencia = $ventas->porReferencia($_GET['referencia']);
        foreach ($porReferencia as $primera) {
            $venta = $primera;
        }
    ?>
    <div>
        <div>
            Descripción: <strong><?php echo $primera[0]; ?></strong>
        </div>
        <div>
            Referencia: <strong><?php echo $primera[1]; ?></strong>
        </div>
        <div>
            Almacén: <strong><?php echo $primera[2]; ?></strong>
        </div>
        <div>
            Cliente: <strong><?php echo $primera[3]; ?></strong>
        </div>
        <div>
            Estado: <strong><?php echo $primera[4]; ?></strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <table id="ventas" class="table">
                <tr>
                    <th>Producto</th>
                    <th>Unidades</th>
                </tr>
                <?php
                $productos = $ventas->productosVenta($_GET['referencia']);
                foreach ($productos as $todo) {
                    echo '<tr><td>'.$todo[0].'</td><td>'.$todo[1].'</td></tr>';
                }
                ?>
            </table>
        </div>
    </div>
</div>
<div id="back" class="col-md-pull-6 derecha"><a href="../home/home.php">volver</a> </div>
</body>
</html>