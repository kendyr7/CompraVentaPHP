<?php
  class Usuario extends Conectar{
    /* TODO: Listar Registros */
    public function get_usuario_x_suc_id($suc_id){
      $conectar=parent::Conexion();
      $sql="SP_L_USUARIO_01 ?";
      $query=$conectar->prepare($sql);
      $query->bindValue(1,$suc_id);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /* TODO: Listar Registro por ID en especifico */
    public function get_usuario_x_usu_id($usu_id){
      $conectar=parent::Conexion();
      $sql="SP_L_USUARIO_02 ?";
      $query=$conectar->prepare($sql);
      $query->bindValue(1,$usu_id);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /* TODO: Eliminar o cambiar estado a eliminado */
    public function delete_usuario($usu_id){
      $conectar=parent::Conexion();
      $sql="SP_D_USUARIO_01 ?";
      $query=$conectar->prepare($sql);
      $query->bindValue(1,$usu_id);
      $query->execute();
    }

    /* TODO: Registro de datos */
    public function insert_usuario($suc_id, $usu_correo, $usu_nom, $usu_ape, $usu_ced, $usu_telf, $usu_pass, $rol_id){
      $conectar=parent::Conexion();
      $sql="SP_I_USUARIO_01 ?,?,?,?,?,?,?,?";
      $query=$conectar->prepare($sql);
      $query->bindValue(1,$suc_id);
      $query->bindValue(2,$usu_correo);
      $query->bindValue(3,$usu_nom);
      $query->bindValue(4,$usu_ape);
      $query->bindValue(5,$usu_ced);
      $query->bindValue(6,$usu_telf);
      $query->bindValue(7,$usu_pass);
      $query->bindValue(8,$rol_id);
      $query->execute();
    }

    /* TODO: Actualizar datos */
    public function update_usuario($usu_id,$suc_id, $usu_correo, $usu_nom, $usu_ape, $usu_ced, $usu_telf, $usu_pass, $rol_id){
      $conectar=parent::Conexion();
      $sql="SP_I_USUARIO_01 ?,?,?,?,?,?,?,?,?";
      $query=$conectar->prepare($sql);
      $query->bindValue(1,$usu_id);
      $query->bindValue(2,$suc_id);
      $query->bindValue(3,$usu_correo);
      $query->bindValue(4,$usu_nom);
      $query->bindValue(5,$usu_ape);
      $query->bindValue(6,$usu_ced);
      $query->bindValue(7,$usu_telf);
      $query->bindValue(8,$usu_pass);
      $query->bindValue(9,$rol_id);
      $query->execute();
    }
  }
?>