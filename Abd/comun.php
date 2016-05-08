<?php
/**
 * Created by PhpStorm.
 * User: wanfra
 * Date: 08/05/2016
 * Time: 19:48
 */
    $database = new PDO('mysql:host=localhost;dbname=almacen_tienda_stock;charset=utf8_general_ci', 'root', '');
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);