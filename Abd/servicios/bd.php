<?php
class BaseDatos {
    private $urlBaseDatos = 'localhost';
    private $usuario = 'root';
    private $password = '';
    private $nombreBaseDatos = 'ana';
    private $charset = 'utf8';
    public $driverBaseDatos = NULL;
    public function __construct() {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $server = $url["host"];
        $username = $url["user"];
        $password = $url["pass"];
        $db = substr($url["path"], 1);
        try  {
            $this->driverBaseDatos = new PDO("mysql:host=$server;dbname=$db;charset=$this->charset", $username, $password);
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
    public function protegidaInjection($sql, $params) {
        $stmt = $this->driverBaseDatos->prepare($sql);
        $stmt->execute($params);
        $resultado = $stmt->fetchAll();
        return $resultado;
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