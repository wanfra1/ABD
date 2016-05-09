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
<div id="divForm">
    <form method="post" action="crearVenta.php" enctype="multipart/form-data">
        <label id="label_descripcion" for="descripcion">Descripcion:</label>
        <input type="text" name="descripcion" id="descripcion">
        <label id="label_tienda" for="tienda">Tienda:</label>
        <select id="tienda" name="tienda">
            <?php
                $tiendas = new Tiendas();
                $todos = $tiendas->todos();
                foreach ($todos as $row) {
                    echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                }
            ?>
        </select>
        <label id="label_almacen" for="almacen">Almacén:</label>
        <select id="almacen" name="almacen">
            <?php
            $almacenes = new Almacenes();
            $todos = $almacenes->todos();
            foreach ($todos as $row) {
                echo '<option value="'.$row[0].'">'.$row[1].'</option>';
            }
            ?>
        </select>
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