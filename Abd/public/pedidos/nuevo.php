<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Registrar pedido</title>
    <link rel="stylesheet" type="text/css" href="../../static/css/styles.css">
</head>
<body>
    <h1 class="page-header col-md-12">NUEVO PEDIDO</h1>
    <?php include '../../servicios/bd.php';?>
    <?php include '../../servicios/pedidos.php';?>
    <?php include '../../servicios/proveedores.php';?>
    <?php include '../../servicios/almacenes.php';?>
    <?php include '../../servicios/productos.php';?>
    <?php

    function opcionesProducto() {
        $productos = new Productos();
        $opciones = '';
        foreach ($productos->todos() as $producto) {
            $opciones.= '<option value="'. $producto[0].'">'.$producto[2].'</option>';
        }
        return $opciones;
    }
    $conError = false;
    $proveedor = '';
    $almacen = '';
    $productos = array();
    $productosExistentes = array();
    $errorProveedor = '';
    $errorAlmacen = '';
    $errorProductos = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['almacen'])) {
            $errorAlmacen = 'Por favor seleccione un almacén';
            $conError = true;
        } else {
            $almacen = $_POST['almacen'];
        }

        if (empty($_POST['proveedor'])) {
            $errorProveedor = 'Por favor seleccione un proveedor';
            $conError = true;
        } else {
            $proveedor = $_POST['proveedor'];
        }
        $i = 1;
        while (isset($_POST['idProducto'.$i])) {
            $productosExistentes[] = array(
                'producto'=>$_POST['idProducto'.$i],
                'cantidad'=>$_POST['cantProducto'.$i]);
            if (empty($_POST['idProducto'.$i]) || empty($_POST['cantProducto'.$i])) {
                $conError = true;
                $errorProductos[] = 'Seleccione una linea valida';
            }

            $i++;
        }
        if (!$conError) {
            $pedidos = new Pedidos();
            $pedidos->guardar($almacen, $proveedor, $productosExistentes);
        }
    }
    ?>

    <div id="divForm">
        <form method="post" action="nuevo.php" enctype="multipart/form-data">
            <label id="label_proveedor" for="proveedor">Proveedor:</label>
            <select id="proveedor" name="proveedor">
                <?php
                $proveedores = new Proveedores();
                $todos = $proveedores->todos();
                echo '<option value="">Seleccione una opción</option>';
                foreach ($todos as $row) {
                    if ($row[0] == $proveedor) {
                        echo '<option value="'.$row[0].'" selected>'.$row[0].' - '.$row[1].'</option>';
                    } else {
                        echo '<option value="'.$row[0].'">'.$row[0].' - '.$row[1].'</option>';
                    }
                }
                ?>
            </select>
            <?php echo $errorProveedor; ?>
            <label id="label_almacen" for="almacen">Almacén:</label>
            <select id="almacen" name="almacen">
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
            <?php echo $errorAlmacen; ?>
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
                        .opcionesProducto()
                        ."</select>"
                        ."<label id='label_cantProducto"
                        .($i + 1)
                        ."' for='cantProducto"
                        .($i + 1)
                        ."'>Cantidad:</label><input id='cantProducto"
                        .($i + 1)
                        ."' name='cantProducto"
                        .($i + 1)
                        ."' type='text' maxlength='3'/><input id='botEliminar"
                        .($i + 1)
                        ."' name='botEliminar"
                        .($i + 1)
                        ."' type='button' class='button' onclick='eliminarProducto(this)' value='Eliminar de la lista'/></div>";
                }
                $productos = new Productos();
                $json = $productos->todosJson();
                echo "<a href='#' id='agregarProducto' onclick='anadirProducto(".$json.")'>Agregar producto</a>";
                ?>
            </div>
            <div id="divSubmit">
                <button class="button" id="submit" type="submit">Enviar</button>
            </div>
        </form>
    </div>
    <div id="back" class="col-md-6 derecha"><a href="../home/home.php">volver</a> </div>
    <script type="text/javascript" src="../../static/js/comun.js"></script>
</body>
</html>