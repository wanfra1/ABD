<?php

class Proveedores {
    public function todos() {
        $bd = new BaseDatos();
        return $bd->getQuery('SELECT * FROM `stock_proveedor`');
    }
    public function guardar($nif, $nombre, $telefono) {
        $bd = new BaseDatos();
        $query = 'INSERT INTO `stock_proveedor` (ID, NOMBRE, TELEFONO) VALUES ("'.$nif.'", "'.$nombre.'", '.$telefono.')';
        $bd->getQuery($query);
    }
    public function editar($nif, $nombre, $telefono) {
        $bd = new BaseDatos();
        $query = 'UPDATE `stock_proveedor` SET NOMBRE="'.$nombre.'", TELEFONO='.$telefono.' WHERE ID="'.$nif.'"';
        $bd->runQuery($query);
    }
}