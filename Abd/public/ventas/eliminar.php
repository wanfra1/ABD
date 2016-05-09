<?php
/**
 * Created by PhpStorm.
 * User: Francisco
 * Date: 09/05/2016
 * Time: 23:29
 */
include '../../servicios/bd.php';
include '../../servicios/ventas.php';
$ventas = new Ventas();
$ventas->eliminar($_POST['id']);