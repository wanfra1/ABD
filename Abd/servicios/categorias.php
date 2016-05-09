<?php
include 'bd.php';

class Categorias {
    public function categorias() {
        $bd = new BaseDatos();
        return $bd->getQuery('SELECT * FROM `stock_categoria`');
    }
}