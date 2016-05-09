<?php

class Proveedores {
    public function todos() {
        $bd = new BaseDatos();
        return $bd->getQuery('SELECT * FROM `stock_proveedor`');
    }
}