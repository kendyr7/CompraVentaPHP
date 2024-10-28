<?php
    session_start();
    class Conectar{
        protected $dbh;

        protected function Conexion(){
            try{
                $conectar = $this->dbh = new PDO("sqlsrv:Server=localhost\\SQLEXPRESS;Database=CompraVenta","sa","root");

                return $conectar;

            }catch (Exception $e){
                print "Error Conexion BD". $e->getMessage() ."<br/>";
                die();
            }
        }

        public static function ruta(){
            return "http://localhost:90/Sistema_de_Control_de_Inventario_Ferreteria/";
        }
    }
?>