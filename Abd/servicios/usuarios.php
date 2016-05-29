<?php

class Usuarios {
    public function obtenerUsuario($usuario, $password) {
        $bd = new BaseDatos();
        $usuarios = $bd->getQuery('SELECT * FROM `usuarios` where email="'.$usuario.'" AND PASSWORD="'.$password.'"');
        foreach ($usuarios as $primero) {
            echo ' jajajajaja';
            echo $primero[0];
            echo $primero[1];
            return $primero;
        }
    }
}