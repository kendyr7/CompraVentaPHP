<?php
/* TODO: Llamando Clases */
  require_once("../config/conexion.php");
  require_once("../models/Proveedor.php");
/* TODO: Inicializando clase */
  $proveedor = new Proveedor();

  switch($_GET["op"]) {
    /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
    case "guardaryeditar":
      if(empty($_POST["prov_id"])){
        $proveedor->insert_proveedor(
          $_POST["emp_id"],
          $_POST["prov_nom"],
          $_POST["prov_ruc"],
          $_POST["prov_telf"],
          $_POST["prov_direcc"],
          $_POST["prov_correo"]
        );
      }else{
        $proveedor->update_proveedor(
          $_POST["prov_id"],
          $_POST["emp_id"],
          $_POST["prov_nom"],
          $_POST["prov_ruc"],
          $_POST["prov_telf"],
          $_POST["prov_direcc"],
          $_POST["prov_correo"]
        );
      }
      break;

    /* TODO: Listado de registros formato JSON para Datatable JS */
    case "listar":
      $datos=$proveedor->get_proveedor_x_emp_id($_POST["emp_id"]);
      $data=Array();
      foreach($datos as $row){
        $sub_array = array();
        $sub_array = $row["prov_nom"];
        $sub_array = $row["prov_ruc"];
        $sub_array = $row["prov_telf"];
        $sub_array = $row["prov_direcc"];
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
      $datos=$proveedor->get_proveedor_x_prov_id($_POST["prov_id"]);
      if(is_array($datos)==true and count($datos)>0){
        foreach($datos as $row){
          $output["prov_id"] = $row["prov_id"];
          $output["emp_id"] = $row["emp_id"];
          $output["prov_nom"] = $row["prov_nom"];
          $output["prov_ruc"] = $row["prov_ruc"];
          $output["prov_telf"] = $row["prov_telf"];
          $output["prov_direcc"] = $row["prov_direcc"];
          $output["prov_correo"] = $row["prov_correo"];
        }
        echo json_encode($output);
      }
      break;

    /* TODO: Cambiar Estado a 0 del Registro */
    case "eliminar":
      $proveedor->delete_proveedor($_POST["prov_id"]);
      break;
  }
?>