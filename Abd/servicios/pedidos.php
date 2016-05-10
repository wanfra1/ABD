<?php

class Pedidos {
    public function pedidos() {
        $bd = new BaseDatos();
        return $bd->getQuery('SELECT * FROM `stock_pedido`');
    }
    public function guardar($almacen, $proveedor, $productosExistentes) {
        $bd = new BaseDatos();
        $query = 'INSERT INTO `stock_pedido` (ID_ALMACEN, ID_PROVEEDOR) VALUES ('.$almacen.', "'.$proveedor.'")';
        $result = $bd->insertarConId($query);
        foreach ($productosExistentes as $i=>$producto) {
            $bd->getQuery('INSERT INTO `stock_lineapedido` (ID_PEDIDO, ID_PRODUCTO, UNIDADES) VALUES ('.$result.', '.$producto['producto'].', '.$producto['cantidad'].')');
            $stockActual = $bd->getQuery('SELECT * FROM `stock_producto_almacen` WHERE ID_ALMACEN='.$almacen.' AND ID_PRODUCTO='.$producto['producto']);
            foreach ($stockActual as $stock) {
                $unidades = $stock[2] + $producto['cantidad'];
                $bd->runQuery('UPDATE `stock_producto_almacen` SET unidades='.$unidades.' WHERE ID_ALMACEN='.$almacen.' AND ID_PRODUCTO='.$producto['producto']);
            }
        }
        echo 'El pedido se ha guardado con exito';
        return $result;
    }
}