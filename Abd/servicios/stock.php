<?php

class Stock {
    public function todos() {
        $bd = new BaseDatos();
        $query='SELECT alm.NOMBRE, pr.NOMBRE, cat.NOMBRE, alpr.UNIDADES FROM `stock_almacen` AS alm INNER JOIN `stock_producto_almacen` AS alpr ON alm.ID = alpr.ID_ALMACEN INNER JOIN `stock_producto` AS pr ON pr.ID = alpr.ID_PRODUCTO INNER JOIN `stock_categoria` AS cat ON pr.ID_CATEGORIA = cat.ID';
        return $bd->getQuery($query);
    }
}