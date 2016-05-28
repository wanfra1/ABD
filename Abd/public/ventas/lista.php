<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Crear venta</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<h1 class="page-header col-md-12">Lista de ventas</h1>
<?php include '../../servicios/bd.php';?>
<?php include '../../servicios/ventas.php';?>
<?php include '../../servicios/almacenes.php';?>
<?php include '../../servicios/productos.php';?>

    <div class="container">
        <div>
            <a href="nueva.php" class="btn btn-primary">Crear nueva</a>
        </div>
        <?php
            session_start();
            if (!isset($_SESSION['valid']) || $_SESSION['valid'] != true) {
                header('Location: accede.php');
            } else {
                $sesion = $_SESSION['valid'];
                echo $sesion;
            }
            if (isset($_GET['mensaje'])) {
                echo $_GET['mensaje'];
            }
        ?>
            <table id="ventas" class="table">
                <tr>
                    <th>Descripcion</th>
                    <th>Referencia</th>
                    <th>Almacen</th>
                    <th>Cliente</th>
                    <th>Acciones</th>
                </tr>
                <?php
                    $ventas = new Ventas();
                    $todos = $ventas->todos();
                    foreach ($todos as $todo) {
                        echo '<tr><td>'.$todo[0].'</td><td>'.$todo[1].'</td><td>'.$todo[2].'</td><td>'.$todo[3].'</td><td><form method="post" action="eliminar.php"><input type="hidden" name="id" value="'.$todo[0].'"><input class="btn btn-primary" type="submit" name="eliminar" value="Eliminar"></form></td></tr>';
                    }
                ?>
            </table>
    </div>
<div id="back" class="col-md-pull-6 derecha"><a href="../home/home.php">volver</a> </div>
</body>
</html>