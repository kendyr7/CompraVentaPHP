<?php
/* TODO: Llamando Clases */
  require_once("../config/conexion.php");
  require_once("../models/Categoria.php");
/* TODO: Inicializando clase */
  $categoria = new Categoria();

  switch($_GET["op"]) {
    /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
    case "guardaryeditar":
      if(empty($_POST["cat_id"])){
        $categoria->insert_categoria($_POST["suc_id"], $_POST["cat_nom"]);
      }else{
        $categoria->update_categoria($_POST["cat_id"], $_POST["suc_id"], $_POST["cat_nom"]);
      }
      break;

    /* TODO: Listado de registros formato JSON para Datatable JS */
    case "listar":
      $datos=$categoria->get_categoria_x_suc_id($_POST["suc_id"]);
      $data=Array();
      foreach($datos as $row){
        $sub_array = array();
        $sub_array = $row["cat_nom"];
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
      $datos=$categoria->get_categoria_x_cat_id($_POST["cat_id"]);
      if(is_array($datos)==true and count($datos)>0){
        foreach($datos as $row){
          $output["cat_id"] = $row["cat_id"];
          $output["suc_id"] = $row["suc_id"];
          $output["cat_nom"] = $row["cat_nom"];
        }
        echo json_encode($output);
      }
      break;

    /* TODO: Cambiar Estado a 0 del Registro */
    case "eliminar":
      $categoria->delete_categoria($_POST["cat_id"]);
      break;
  }
?>