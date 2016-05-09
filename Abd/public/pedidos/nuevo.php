<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Registrar pedido</title>
    <link rel="stylesheet" type="text/css" href="../../static/css/styles.css">
</head>
<body>
    <h1>Nuevo pedido</h1>
    <?php include '../../servicios/bd.php';?>
    <?php include '../../servicios/proveedores.php';?>
    <?php include '../../servicios/almacenes.php';?>
    <?php include '../../servicios/productos.php';?>
    <?php
    $proveedor = '';
    $almacen = '';
    $productos = array();
    $errorProveedor = '';
    $errorAlmacen = '';
    $errorProductos = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['almacen'])) {
            $errorAlmacen = 'Por favor seleccione un almacén';
        } else {
            $almacen = $_POST['almacen'];
        }

        if (empty($_POST['proveedor'])) {
            $errorProveedor = 'Por favor seleccione un proveedor';
        } else {
            $proveedor = $_POST['proveedor'];
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