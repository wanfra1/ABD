<?php
class BaseDatos {
    private $urlBaseDatos = 'localhost';
    private $usuario = 'root';
    private $password = '';
    private $nombreBaseDatos = 'ana';
    private $charset = 'utf8';
    public $driverBaseDatos = NULL;
    public function __construct() {
        try  {
            $this->driverBaseDatos = new PDO("mysql:host=$this->urlBaseDatos;dbname=$this->nombreBaseDatos;charset=$this->charset", $this->usuario, $this->password);
        } catch(PDOException $e) {
            echo __LINE__.$e->getMessage();
        }
    }
    public function __destruct() {
        $this->driverBaseDatos = NULL;
    }
    public function runQuery($sql) {
        try {
            $count = $this->driverBaseDatos->exec($sql) or print_r($this->driverBaseDatos->errorInfo());
        }  catch(PDOException $e) {
            echo __LINE__.$e->getMessage();
        }
    }
    public function getQuery($sql) {
        $stmt = $this->driverBaseDatos->query($sql);
        return $stmt;
    }
    public function insertarConId($sql) {
        $this->runQuery($sql);
        return $this->driverBaseDatos->lastInsertId();
    }
}
?>