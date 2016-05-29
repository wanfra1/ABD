<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Registrar venta</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<?php include '../../servicios/bd.php';?>
<?php include '../../servicios/ventas.php';?>
<?php include '../../servicios/almacenes.php';?>
<?php include '../../servicios/productos.php';?>
<?php include '../../servicios/clientes.php';?>
<?php
    session_start();
    if (!isset($_SESSION['valid']) || $_SESSION['valid'] != true) {
        header('Location: accede.php');
    }
    function opcionesProducto($seleccionado) {
        $productos = new Productos();
        $opciones = '';
        foreach ($productos->todos() as $producto) {
            if ($producto[0] == $seleccionado) {
                $opciones.= '<option value="'. $producto[0].'" selected>'.$producto[2].'</option>';
            } else {
                $opciones.= '<option value="'. $producto[0].'">'.$producto[2].'</option>';
            }

        }
        return $opciones;
    }
    $conError = false;
    $descripcion = '';
    $tienda = '';
    $almacen = '';
    $cliente = '';
    $productosExistentes = array();
    $errorDescripcion = '';
    $errorTienda = '';
    $errorAlmacen = '';
    $errorCliente = '';
    $errorProductos = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['descripcion'])) {
            $errorDescripcion = 'Por favor introduzca una descripción';
            $conError = true;
        } else {
            $descripcion = $_POST['descripcion'];
        }

        if (empty($_POST['almacen'])) {
            $errorAlmacen = 'Por favor seleccione un almacén de destino';
            $conError = true;
        } else {
            $almacen = $_POST['almacen'];
        }

        if (empty($_POST['cliente'])) {
            $errorCliente = 'Por favor seleccione un cliente';
            $conError = true;
        } else {
            $cliente = $_POST['cliente'];
        }

        $i = 1;
        while (isset($_POST['idProducto'.$i])) {
            $productosExistentes[] = array(
                'producto'=>$_POST['idProducto'.$i],
                'cantidad'=>$_POST['cantProducto'.$i]);
            if (empty($_POST['idProducto'.$i]) || empty($_POST['cantProducto'.$i])) {
                $conError = true;
                $errorProductos[] = 'Seleccione una linea valida';
            } else if (!ctype_digit($_POST['cantProducto'.$i])) {
                $conError = true;
                $errorProductos[] = 'Debe ser numerico';
            }

            $i++;
        }
        if (!$conError) {
            $ventas = new Ventas();
            $ventas->guardar($almacen, $descripcion, $productosExistentes, $cliente);
            header("Location: lista.php?mensaje='Has creado la venta con exito");
        }
    }
?>
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
    <h1 class="page-header col-md-12">Nueva venta</h1>
    <form id="venta" onsubmit="return validarVenta()" method="post" action="nueva.php" enctype="multipart/form-data">
        <div>
            <span id="errorProductoVacio"></span>
        </div>
        <div class="form-group <?php if ($errorDescripcion != '') echo 'has-error' ?>">
            <label id="label_descripcion" for="descripcion">Descripcion:</label>
            <input class="form-control" type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>">
            <span id="erroresDescripcion" class="help-block"><?php echo $errorDescripcion; ?></span>
        </div>
        <div class="form-group <?php if ($errorAlmacen != '') echo 'has-error' ?>">
            <label id="label_almacen" for="almacen">Almacén:</label>
            <select id="almacen" name="almacen" class="form-control">
                <?php
                $almacenes = new Almacenes();
                $todos = $almacenes->todos();
                echo '<option value="">Seleccione una opción</option>';
                foreach ($todos as $row) {
                    if ($row[0] == $almacen) {
                        echo '<option value="'.$row[0].'" selected>'.$row[1].'</option>';
                    } else {
                        echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                    }
                }
                ?>
            </select>
            <span id="erroresAlmacen" class="help-block"><?php echo $errorAlmacen; ?></span>
        </div>
        <div class="form-group <?php if ($errorCliente != '') echo 'has-error' ?>">
            <label id="label_cliente" for="cliente">Cliente:</label>
            <select id="cliente" name="cliente" class="form-control">
                <?php
                $clientes = new Clientes();
                $todos = $clientes->todos();
                echo '<option value="">Seleccione una opción</option>';
                foreach ($todos as $row) {
                    if ($row[0] == $almacen) {
                        echo '<option value="'.$row[0].'" selected>'.$row[1].'</option>';
                    } else {
                        echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                    }
                }
                ?>
            </select>
            <span id="erroresClientes" class="help-block"><?php echo $errorCliente; ?></span>
        </div>
        <div id="divProductos" class="divProductos">
            <?php
                foreach ($productosExistentes as $i=>$producto) {
                    echo "<div id='producto".($i + 1)
                    ."'><label id='label_idProducto"
                    .($i + 1)
                    ."' for='idProducto"
                    .($i + 1)
                    ."'>Producto:</label><select id='idProducto"
                    .($i + 1)
                    ."' name='idProducto"
                    .($i + 1)
                    ."'>"
                    .opcionesProducto($producto['producto'])
                    ."</select>"
                    ."<label id='label_cantProducto"
                    .($i + 1)
                    ."' for='cantProducto"
                    .($i + 1)
                    ."'>Cantidad:</label><input id='cantProducto"
                    .($i + 1)
                    ."' name='cantProducto"
                    .($i + 1)
                    ."' type='text' maxlength='3' value='".$producto['cantidad']."'/><input id='botEliminar"
                    .($i + 1)
                    ."' name='botEliminar"
                    .($i + 1)
                    ."' type='button' class='button' onclick='eliminarProducto(this)' value='Eliminar de la lista'/><span id=".($i + 1)."></span></div>";
                }
                $productos = new Productos();
                $json = $productos->todosJson();
                echo "<a href='#' id='agregarProducto' onclick='anadirProducto(".$json.")'>Agregar producto</a>";
            ?>
        </div>
        <input type="hidden" id="numRepeticiones" name="numRepeticiones" value="0">
        <div id="divSubmit">
            <input class="btn btn-primary" id="submit" type="submit" value="Enviar">
        </div>
    </form>
</div>
<div id="back" class="col-md-pull-6 derecha"><a href="../home/home.php">volver</a> </div>
<script type="text/javascript" src="../../static/js/comun.js"></script>
</body>
</html>