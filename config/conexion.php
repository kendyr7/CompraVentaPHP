<?php
  class Conectar {
    protected $dbh;

    protected function Conexion(){
      try {
        $conectar = $this->dbh=new PDO("sqlsrv:Server=localhostlDatabase=CompraVenta", "sa","root");
        return $conectar;
      }catch (Exception $e) {
        print "Error Conexio DB". $e->getMessage() ."<br/>";
      }
    }
  }
?>