<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Crear venta</title>
</head>
<body>
<h1>Nueva venta</h1>
<?php include '../../servicios/bd.php';?>
<?php include '../../servicios/tiendas.php';?>
<?php include '../../servicios/almacenes.php';?>
<?php include '../../servicios/productos.php';?>
<?php
    $descripcion = '';
    $tienda = '';
    $almacen = '';
    $productos = array();
    $errorDescripcion = '';
    $errorTienda = '';
    $errorAlmacen = '';
    $errorProductos = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['descripcion'])) {
            $errorDescripcion = 'Por favor introduzca una descripción';
        } else {
            $descripcion = $_POST['descripcion'];
        }

        if (empty($_POST['tienda'])) {
            $errorTienda = 'Por favor seleccione una tienda destino';
        } else {
            $tienda = $_POST['tienda'];
        }

        if (empty($_POST['almacen'])) {
            $errorAlmacen = 'Por favor seleccione un almacén de destino';
        } else {
            $almacen = $_POST['almacen'];
        }
    }
?>
<div id="divForm">
    <form method="post" action="nueva.php" enctype="multipart/form-data">
        <label id="label_descripcion" for="descripcion">Descripcion:</label>
        <input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>">
        <?php echo $errorDescripcion; ?>
        <label id="label_tienda" for="tienda">Tienda:</label>
        <select id="tienda" name="tienda">
            <?php
                $tiendas = new Tiendas();
                $todos = $tiendas->todos();
                echo '<option value="">Seleccione una opción</option>';
                foreach ($todos as $row) {
                    if ($row[0] == $tienda) {
                        echo '<option value="'.$row[0].'" selected>'.$row[1].'</option>';
                    } else {
                        echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                    }
                }
            ?>
        </select>
        <?php echo $errorTienda; ?>
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
                $productos = new Productos();
                $json = $productos->todosJson();
                echo "<a href='#' id='agregarProducto' onclick='anadirProducto(".$json.")'>Agregar producto</a>";
            ?>
        </div>
        <div id="divSubmit">
            <button id="submit" type="submit">Enviar</button>
        </div>
    </form>
</div>
<script type="text/javascript" src="../../static/js/comun.js"></script>
</body>
</html>