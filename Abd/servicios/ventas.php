<?php
include 'bd.php';

class Ventas {
    public function tiendas() {
        $bd = new BaseDatos();
        return $bd->getQuery('SELECT * FROM `stock_tienda`');
    }
}