<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Venta.php");
    /* TODO: Inicializando clase */
    $venta = new Venta();

    switch($_GET["op"]){

        case "registrar":
            $datos=$venta->insert_venta_x_suc_id($_POST["suc_id"],$_POST["usu_id"]);
            foreach($datos as $row){
                $output["VENT_ID"] = $row["VENT_ID"];
            }
            echo json_encode($output);
            break;

        case "guardardetalle":
            $datos=$venta->insert_venta_detalle($_POST["vent_id"],$_POST["prod_id"],$_POST["prod_pventa"],$_POST["detv_cant"]);
            break;

        case "calculo":
            $datos=$venta->get_venta_calculo($_POST["vent_id"]);
            foreach($datos as $row){
                $output["VENT_SUBTOTAL"] = $row["VENT_SUBTOTAL"];
                $output["VENT_IGV"] = $row["VENT_IGV"];
                $output["VENT_TOTAL"] = $row["VENT_TOTAL"];
            }
            echo json_encode($output);
            break;

        case "eliminardetalle":
            $venta->delete_venta_detalle($_POST["detv_id"]);
            break;

        case "listardetalle":
            $datos=$venta->get_venta_detalle($_POST["vent_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                if ($row["PROD_IMG"] != ''){
                    $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                        "<div class='flex-shrink-0 me-2'>".
                            "<img src='../../assets/producto/".$row["PROD_IMG"]."' alt='' class='avatar-xs rounded-circle'>".
                        "</div>".
                    "</div>";
                }else{
                    $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                        "<div class='flex-shrink-0 me-2'>".
                            "<img src='../../assets/producto/no_imagen.png' alt='' class='avatar-xs rounded-circle'>".
                        "</div>".
                    "</div>";
                }
                $sub_array[] = $row["CAT_NOM"];
                $sub_array[] = $row["PROD_NOM"];
                $sub_array[] = $row["UND_NOM"];
                $sub_array[] = $row["PROD_PVENTA"];
                $sub_array[] = $row["DETV_CANT"];
                $sub_array[] = $row["DETV_TOTAL"];
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["DETV_ID"].','.$row["VENT_ID"].')" id="'.$row["DETV_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "listardetalleformato";
            $datos=$venta->get_venta_detalle($_POST["vent_id"]);
            foreach($datos as $row){
                ?>
                     <tr>
                        <td>
                            <?php 
                                if ($row["PROD_IMG"] != ''){
                                    ?>
                                        <?php
                                            echo "<div class='d-flex align-items-center'>" .
                                                    "<div class='flex-shrink-0 me-2'>".
                                                        "<img src='../../assets/producto/".$row["PROD_IMG"]."' alt='' class='avatar-xs rounded-circle'>".
                                                    "</div>".
                                                "</div>";
                                        ?>
                                    <?php
                                }else{
                                    ?>
                                        <?php 
                                            echo "<div class='d-flex align-items-center'>" .
                                                    "<div class='flex-shrink-0 me-2'>".
                                                        "<img src='../../assets/producto/no_imagen.png' alt='' class='avatar-xs rounded-circle'>".
                                                    "</div>".
                                                "</div>";
                                        ?>
                                    <?php
                                }
                            ?>
                        </td>
                        <td><?php echo $row["CAT_NOM"];?></td>
                        <td><?php echo $row["PROD_NOM"];?></td>
                        <td scope="row"><?php echo $row["UND_NOM"];?></td>
                        <td><?php echo $row["PROD_PVENTA"];?></td>
                        <td><?php echo $row["DETV_CANT"];?></td>
                        <td class="text-end"><?php echo $row["DETV_TOTAL"];?></td>
                    </tr>
                <?php
            }
            break;

        case "guardar":
            $datos=$venta->update_venta(
                $_POST["vent_id"],
                $_POST["pag_id"],
                $_POST["cli_id"],
                $_POST["cli_ruc"],
                $_POST["cli_direcc"],
                $_POST["cli_correo"],
                $_POST["vent_coment"],
                $_POST["mon_id"],
                $_POST["doc_id"]
            );
            break;

        case "mostrar":
            $datos=$venta->get_venta($_POST["vent_id"]);
            foreach($datos as $row){
                $output["VENT_ID"] = $row["VENT_ID"];
                $output["SUC_ID"] = $row["SUC_ID"];
                $output["PAG_ID"] = $row["PAG_ID"];
                $output["PAG_NOM"] = $row["PAG_NOM"];
                $output["CLI_ID"] = $row["CLI_ID"];
                $output["CLI_RUC"] = $row["CLI_RUC"];
                $output["CLI_DIRECC"] = $row["CLI_DIRECC"];
                $output["CLI_CORREO"] = $row["CLI_CORREO"];
                $output["VENT_SUBTOTAL"] = $row["VENT_SUBTOTAL"];
                $output["VENT_IGV"] = $row["VENT_IGV"];
                $output["VENT_TOTAL"] = $row["VENT_TOTAL"];
                $output["VENT_COMENT"] = $row["VENT_COMENT"];
                $output["USU_ID"] = $row["USU_ID"];
                $output["USU_NOM"] = $row["USU_NOM"];
                $output["USU_APE"] = $row["USU_APE"];
                $output["USU_CORREO"] = $row["USU_CORREO"];
                $output["MON_ID"] = $row["MON_ID"];
                $output["MON_NOM"] = $row["MON_NOM"];
                $output["FECH_CREA"] = $row["FECH_CREA"];
                $output["SUC_NOM"] = $row["SUC_NOM"];
                $output["EMP_NOM"] = $row["EMP_NOM"];
                $output["EMP_RUC"] = $row["EMP_RUC"];
                $output["EMP_CORREO"] = $row["EMP_CORREO"];
                $output["EMP_TELF"] = $row["EMP_TELF"];
                $output["EMP_DIRECC"] = $row["EMP_DIRECC"];
                $output["EMP_PAG"] = $row["EMP_PAG"];
                $output["COM_NOM"] = $row["COM_NOM"];
                $output["CLI_NOM"] = $row["CLI_NOM"];
            }
            echo json_encode($output);
            break;

        case "listarventa":
            $datos=$venta->get_venta_listado($_POST["suc_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = "V-".$row["VENT_ID"];
                $sub_array[] = $row["DOC_NOM"];
                $sub_array[] = $row["CLI_RUC"];
                $sub_array[] = $row["CLI_NOM"];
                $sub_array[] = $row["PAG_NOM"];
                $sub_array[] = $row["MON_NOM"];
                $sub_array[] = $row["VENT_SUBTOTAL"];
                $sub_array[] = $row["VENT_IGV"];
                $sub_array[] = $row["VENT_TOTAL"];
                $sub_array[] = $row["USU_NOM"]." ".$row["USU_APE"];
                if ($row["USU_IMG"] != ''){
                    $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                        "<div class='flex-shrink-0 me-2'>".
                            "<img src='../../assets/usuario/".$row["USU_IMG"]."' alt='' class='avatar-xs rounded-circle'>".
                        "</div>".
                    "</div>";
                }else{
                    $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                        "<div class='flex-shrink-0 me-2'>".
                            "<img src='../../assets/usuario/no_imagen.png' alt='' class='avatar-xs rounded-circle'>".
                        "</div>".
                    "</div>";
                }
                $sub_array[] = '<a href="../ViewVenta/?v='.$row["VENT_ID"].'" target="_blank" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-printer-line"></i></a>';
                $sub_array[] = '<button type="button" onClick="ver('.$row["VENT_ID"].')" id="'.$row["VENT_ID"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="ri-settings-2-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

    }
?>