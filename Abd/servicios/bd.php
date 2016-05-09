<?php
class BaseDatos {
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbName = 'almacen_tienda_stock';
    private $charset = 'utf8';
    public $dbh = NULL;
    public function __construct() {
        try  {
            $this->dbh = new PDO("mysql:host=$this->hostname;dbname=$this->dbName;charset=$this->charset", $this->username, $this->password);
        } catch(PDOException $e) {
            echo __LINE__.$e->getMessage();
        }
    }
    public function __destruct() {
        $this->dbh = NULL; // Setting the handler to NULL closes the connection propperly
    }
    public function runQuery($sql) {
        try {
            $count = $this->dbh->exec($sql) or print_r($this->dbh->errorInfo());
        }
        catch(PDOException $e) {
            echo __LINE__.$e->getMessage();
        }
    }
    public function getQuery($sql) {
        $stmt = $this->dbh->query($sql);
        return $stmt;
    }
}
?>