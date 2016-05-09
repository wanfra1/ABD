<?php

class Pedidos {
    public function pedidos() {
        $bd = new BaseDatos();
        return $bd->getQuery('SELECT * FROM `stock_pedido`');
    }
}