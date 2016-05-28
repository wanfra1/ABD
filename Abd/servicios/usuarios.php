<?php

class Usuarios {
    public function obtenerUsuario($usuario, $password) {
        $bd = new BaseDatos();
        $usuarios = $bd->getQuery('SELECT * FROM `usuarios` where email="'.$usuario.'" AND PASSWORD="'.$password.'"');
        foreach ($usuarios as $primero) {
            return $primero;
        }
    }
}