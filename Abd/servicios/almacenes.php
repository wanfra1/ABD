<?php
include 'bd.php';

class Almacenes {
    public function todos() {
        $bd = new BaseDatos();
        return $bd->getQuery('SELECT * FROM `stock_almacen`');
    }
}