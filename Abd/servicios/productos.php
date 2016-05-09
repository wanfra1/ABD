<?php

class Productos {
    public function todos() {
        $bd = new BaseDatos();
        return $bd->getQuery('SELECT * FROM `stock_producto`');
    }
    public function todosJson() {
        $json = array();
        $todos = $this->todos();
        foreach ($todos as $producto) {
            $json[] = array(
                'id'=> $producto[0],
                'nombre'=>$producto[2]);
        }
        return json_encode($json);
    }
}