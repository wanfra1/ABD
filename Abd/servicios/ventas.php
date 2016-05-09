<?php

class Ventas {
    public function todos() {
        $bd = new BaseDatos();
        return $bd->getQuery('SELECT * FROM `stock_venta`');
    }
    public function guardar($almacen, $descripcion, $productosExistentes) {
        $bd = new BaseDatos();
        $query = 'INSERT INTO `stock_venta` (ID, ID_ALMACEN, DESCRIPCION) VALUES (NULL, '.$almacen.', "'.$descripcion.'")';
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
}