<?php

class Clientes {
    public function todos() {
        $bd = new BaseDatos();
        return $bd->getQuery('SELECT * FROM `clientes`');
    }
}