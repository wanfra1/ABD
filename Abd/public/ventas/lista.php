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
    <h1 class="page-header col-md-12">Lista de ventas</h1>
        <div>
            <a href="nueva.php" class="btn btn-primary">Crear nueva</a>
        </div>
        <?php
            session_start();
            if (!isset($_SESSION['valid']) || $_SESSION['valid'] != true) {
                header('Location: accede.php');
            }
            if (isset($_GET['mensaje'])) {
                echo $_GET['mensaje'];
            }
        ?>
            <div class="row">
                <h2>Filtrar</h2>
                <form class="form-inline" method="get">
                    <div class="form-group">
                        <label for="referencia">Referencia:</label>
                        <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Introduzca referencia">
                    </div>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div>
            <table id="ventas" class="table">
                <tr>
                    <th>Descripcion</th>
                    <th>Referencia</th>
                    <th>Almacen</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                <?php
                    $ventas = new Ventas();
                    if (isset($_GET['referencia']) && !empty($_GET['referencia'])) {
                        $todos = $ventas->porReferencia($_GET['referencia']);
                    } else {
                        $todos = $ventas->todos();
                    }
                    foreach ($todos as $todo) {
                        echo '<tr><td>'.$todo[0].'</td><td>'.$todo[1].'</td><td>'.$todo[2].'</td><td>'.$todo[3].'</td><td>'.$todo[4].'</td><td><form method="post" action="eliminar.php"><input type="hidden" name="id" value="'.$todo[0].'"><input class="btn btn-secondary" type="submit" name="eliminar" value="Eliminar"><a href="detalle.php?referencia='.$todo[1].'" class="btn btn-secondary">Ver</a></form></td></tr>';
                    }
                ?>
            </table>
    </div>
<div id="back" class="col-md-pull-6 derecha"><a href="../home/home.php">volver</a> </div>
</body>
</html>