<?php
/* TODO: Llamando Clases */
  require_once("../config/conexion.php");
  require_once("../models/Cliente.php");
/* TODO: Inicializando clase */
  $cliente = new Cliente();

  switch($_GET["op"]) {
    /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
    case "guardaryeditar":
      if(empty($_POST["cli_id"])){
        $cliente->insert_cliente(
          $_POST["emp_id"],
          $_POST["cli_nom"],
          $_POST["cli_ruc"],
          $_POST["cli_telf"],
          $_POST["cli_direcc"],
          $_POST["cli_correo"]
        );
      }else{
        $cliente->update_cliente(
          $_POST["cli_id"],
          $_POST["emp_id"],
          $_POST["cli_nom"],
          $_POST["cli_ruc"],
          $_POST["cli_telf"],
          $_POST["cli_direcc"],
          $_POST["cli_correo"]
        );
      }
      break;

    /* TODO: Listado de registros formato JSON para Datatable JS */
    case "listar":
      $datos=$cliente->get_cliente_x_emp_id($_POST["emp_id"]);
      $data=Array();
      foreach($datos as $row){
        $sub_array = array();
        $sub_array = $row["cli_nom"];
        $sub_array = $row["cli_ruc"];
        $sub_array = $row["cli_telf"];
        $sub_array = $row["cli_direcc"];
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
      $datos=$cliente->get_cliente_x_cli_id($_POST["cli_id"]);
      if(is_array($datos)==true and count($datos)>0){
        foreach($datos as $row){
          $output["cli_id"] = $row["cli_id"];
          $output["emp_id"] = $row["emp_id"];
          $output["cli_nom"] = $row["cli_nom"];
          $output["cli_ruc"] = $row["cli_ruc"];
          $output["cli_telf"] = $row["cli_telf"];
          $output["cli_direcc"] = $row["cli_direcc"];
          $output["cli_correo"] = $row["cli_correo"];
        }
        echo json_encode($output);
      }
      break;

    /* TODO: Cambiar Estado a 0 del Registro */
    case "eliminar":
      $cliente->delete_cliente($_POST["cli_id"]);
      break;
  }
?>