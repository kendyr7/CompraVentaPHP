<?php
/* TODO: Llamando Clases */
  require_once("../config/conexion.php");
  require_once("../models/Moneda.php");
/* TODO: Inicializando clase */
  $moneda = new Moneda();

  switch($_GET["op"]) {
    /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
    case "guardaryeditar":
      if(empty($_POST["mon_id"])){
        $moneda->insert_moneda($_POST["suc_id"], $_POST["mon_nom"]);
      }else{
        $moneda->update_moneda($_POST["mon_id"], $_POST["suc_id"], $_POST["mon_nom"]);
      }
      break;

    /* TODO: Listado de registros formato JSON para Datatable JS */
    case "listar":
      $datos=$moneda->get_moneda_x_suc_id($_POST["suc_id"]);
      $data=Array();
      foreach($datos as $row){
        $sub_array = array();
        $sub_array = $row["mon_nom"];
        $sub_array = "Editar";
        $sub_array = "Eliminar";
        $data[] = $sub_array;
      }

      $results = array(
        "sEcho"=>1,
        "iTotalRecords"=>count($data),
        "iTotalDisplayRecords"=>count($data),
        "aaData"=>$data);
      echo json_encode($results);
      break;

    /* TODO: Mostrar informacion de registro segun su ID */
    case "mostrar":
      $datos=$moneda->get_moneda_x_mon_id($_POST["mon_id"]);
      if(is_array($datos)==true and count($datos)>0){
        foreach($datos as $row){
          $output["mon_id"] = $row["mon_id"];
          $output["suc_id"] = $row["suc_id"];
          $output["mon_nom"] = $row["mon_nom"];
        }
        echo json_encode($output);
      }
      break;

    /* TODO: Cambiar Estado a 0 del Registro */
    case "eliminar":
      $moneda->delete_moneda($_POST["mon_id"]);
      break;
  }
?>