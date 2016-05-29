<?php

class Ventas {
    public function todos() {
        $bd = new BaseDatos();
        return $bd->getQuery('SELECT venta.descripcion, venta.referencia, almacen.nombre, cliente.nombre, venta.estado FROM `stock_venta` AS venta INNER JOIN `clientes` AS cliente ON cliente.ID = venta.cliente INNER JOIN `stock_almacen` AS almacen ON almacen.ID = venta.ID_ALMACEN' );
    }
    public function porReferencia($referencia) {
        $bd = new BaseDatos();
        return $bd->protegidaInjection('SELECT venta.descripcion, venta.referencia, almacen.nombre, cliente.nombre, venta.estado FROM '.
            '`stock_venta` AS venta '.
            'INNER JOIN `clientes` AS cliente ON cliente.ID = venta.cliente '.
            'INNER JOIN `stock_almacen` AS almacen ON almacen.ID = venta.ID_ALMACEN '.
            'WHERE venta.referencia = :referencia', array('referencia'=>$referencia));
    }
    public function guardar($almacen, $descripcion, $productosExistentes, $cliente) {
        $bd = new BaseDatos();
        $query = 'INSERT INTO `stock_venta` (ID, ID_ALMACEN, DESCRIPCION, cliente, referencia, estado) VALUES (NULL, '.$almacen.', "'.$descripcion.'", '.$cliente.', "'.rand(0, 10000).'", "PAGADO")';
        $result = $bd->insertarConId($query);
        foreach ($productosExistentes as $i=>$producto) {
            $bd->getQuery('INSERT INTO `stock_lineaventa` (ID_VENTA, ID_PRODUCTO, UNIDADES) VALUES ('.$result.', '.$producto['producto'].', '.$producto['cantidad'].')');
            $stockActual = $bd->getQuery('SELECT * FROM `stock_producto_almacen` WHERE ID_ALMACEN='.$almacen.' AND ID_PRODUCTO='.$producto['producto']);
            foreach ($stockActual as $stock) {
                $unidades = $stock[2] - $producto['cantidad'];
                $bd->runQuery('UPDATE `stock_producto_almacen` SET unidades='.$unidades.' WHERE ID_ALMACEN='.$almacen.' AND ID_PRODUCTO='.$producto['producto']);
            }
        }
        return $result;
    }
    public function eliminar($id) {
        $bd = new BaseDatos();
        $venta = $bd->getQuery('SELECT * FROM `stock_venta` WHERE ID='.$id);
        foreach ($venta as $item) {
            $productosVendidos = $bd->getQuery('SELECT * FROM `stock_lineaventa` WHERE ID_VENTA='.$id);
            foreach ($productosVendidos as $producto) {
                $stockActual = $bd->getQuery('SELECT * FROM `stock_producto_almacen` WHERE ID_ALMACEN='.$item[1].' AND ID_PRODUCTO='.$producto[1]);
                foreach ($stockActual as $stock) {
                    $unidades = $producto[2] + $stock[2];
                    echo "Se ha eliminado con exito";
                    $bd->runQuery('UPDATE `stock_producto_almacen` SET unidades='.$unidades.' WHERE ID_ALMACEN='.$item[1].' AND ID_PRODUCTO='.$producto[1]);
                }
                $bd->getQuery('DELETE FROM `stock_lineaventa` WHERE ID_VENTA='.$id);
            }
            $bd->getQuery('DELETE FROM `stock_venta` WHERE ID='.$id);
        }
    }
    public function productosVenta($referencia) {
        $bd = new BaseDatos();
        return $bd->getQuery('SELECT producto.nombre, lineaventa.unidades FROM `stock_lineaventa` AS lineaventa INNER JOIN `stock_producto` AS producto ON producto.ID = lineaventa.id_producto WHERE lineaventa.id_venta = (select id from stock_venta where referencia="'.$referencia.'")' );
    }
}