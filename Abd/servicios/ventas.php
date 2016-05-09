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
        }
        return $result;
    }
}