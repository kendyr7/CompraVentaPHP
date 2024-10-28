<?php
    class Compra extends Conectar{

        /* TODO: Listar Registro por ID en especifico */
        public function insert_compra_x_suc_id($suc_id,$usu_id){
            $conectar=parent::Conexion();
            $sql="SP_I_COMPRA_01 ?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->bindValue(2,$usu_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_compra_detalle($compr_id,$prod_id,$prod_pcompra,$detc_cant){
            $conectar=parent::Conexion();
            $sql="SP_I_COMPRA_02 ?,?,?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$compr_id);
            $query->bindValue(2,$prod_id);
            $query->bindValue(3,$prod_pcompra);
            $query->bindValue(4,$detc_cant);
            $query->execute();
            //return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_compra_detalle($compr_id){
            $conectar=parent::Conexion();
            $sql="SP_L_COMPRA_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$compr_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_compra_detalle($detc_id){
            $conectar=parent::Conexion();
            $sql="SP_D_COMPRA_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$detc_id);
            $query->execute();
        }

        public function get_compra_calculo($compr_id){
            $conectar=parent::Conexion();
            $sql="SP_U_COMPRA_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$compr_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_compra($compr_id,$pag_id,$prov_id,$prov_ruc,$prov_direcc,$prov_correo,$compr_coment,$mon_id,$doc_id){
            $conectar=parent::Conexion();
            $sql="SP_U_COMPRA_03 ?,?,?,?,?,?,?,?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$compr_id);
            $query->bindValue(2,$pag_id);
            $query->bindValue(3,$prov_id);
            $query->bindValue(4,$prov_ruc);
            $query->bindValue(5,$prov_direcc);
            $query->bindValue(6,$prov_correo);
            $query->bindValue(7,$compr_coment);
            $query->bindValue(8,$mon_id);
            $query->bindValue(9,$doc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_compra($compr_id){
            $conectar=parent::Conexion();
            $sql="SP_L_COMPRA_02 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$compr_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_compra_listado($suc_id){
            $conectar=parent::Conexion();
            $sql="SP_L_COMPRA_03 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

    }
?>