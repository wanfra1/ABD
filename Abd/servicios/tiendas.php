<?php
include 'bd.php';

class Tiendas {
    public function todos() {
        $bd = new BaseDatos();
        return $bd->getQuery('SELECT * FROM `stock_tienda`');
    }
}