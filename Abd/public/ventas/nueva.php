<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Registrar venta</title>
    <link rel="stylesheet" type="text/css" href="../../static/css/styles.css">
</head>
<body>
<h1 class="page-header col-md-12">NUEVA VENTA</h1>
<?php include '../../servicios/bd.php';?>
<?php include '../../servicios/ventas.php';?>
<?php include '../../servicios/almacenes.php';?>
<?php include '../../servicios/productos.php';?>
<?php

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
    $productosExistentes = array();
    $errorDescripcion = '';
    $errorTienda = '';
    $errorAlmacen = '';
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
            $ventas->guardar($almacen, $descripcion, $productosExistentes);
            header("Location: lista.php?mensaje='Has creado la venta con exito");
        }
    }
?>
<div id="divForm">
    <form id="venta" onsubmit="return validarVenta()" method="post" action="nueva.php" enctype="multipart/form-data">
        <div>
            <span id="errorProductoVacio"></span>
        </div>
        <label id="label_descripcion" for="descripcion">Descripcion:</label>
        <input class="inputSelect" type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>">
        <span id="erroresDescripcion"><?php echo $errorDescripcion; ?></span>
        <label id="label_almacen" for="almacen">Almacén:</label>
        <select id="almacen" name="almacen" class="inputSelect">
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
        <span id="erroresAlmacen"><?php echo $errorAlmacen; ?></span>
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
            <input class="button" id="submit" type="submit" value="Enviar">
        </div>
    </form>
</div>
<div id="back" class="col-md-6 derecha"><a href="../home/home.php">volver</a> </div>
<script type="text/javascript" src="../../static/js/comun.js"></script>
</body>
</html>