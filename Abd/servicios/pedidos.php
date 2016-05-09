<?php

class Pedidos {
    public function pedidos() {
        $bd = new BaseDatos();
        return $bd->getQuery('SELECT * FROM `stock_pedido`');
    }
    public function guardar($almacen, $proveedor, $productosExistentes) {
        $bd = new BaseDatos();
        $query = 'INSERT INTO `stock_pedido` (ID, ID_ALMACEN, ID_PROVEEDOR) VALUES (NULL, '.$almacen.', "'.$proveedor.'")';
        $result = $bd->insertarConId($query);
        foreach ($productosExistentes as $i=>$producto) {
            $bd->getQuery('INSERT INTO `stock_lineapedido` (ID_PEDIDO, ID_PRODUCTO, UNIDADES) VALUES ('.$result.', '.$producto['producto'].', '.$producto['cantidad'].')');
        }
        return $result;
    }
}