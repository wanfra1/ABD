<?php

class Categorias {
    public function todas() {
        $bd = new BaseDatos();
        return $bd->getQuery('SELECT * FROM `stock_categoria`');
    }
}