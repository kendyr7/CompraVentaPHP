<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Compra.php");
    /* TODO: Inicializando clase */
    $compra = new Compra();

    switch($_GET["op"]){

        case "registrar":
            $datos=$compra->insert_compra_x_suc_id($_POST["suc_id"],$_POST["usu_id"]);
            foreach($datos as $row){
                $output["COMPR_ID"] = $row["COMPR_ID"];
            }
            echo json_encode($output);
            break;

        case "guardardetalle":
            $datos=$compra->insert_compra_detalle($_POST["compr_id"],$_POST["prod_id"],$_POST["prod_pcompra"],$_POST["detc_cant"]);
            break;

        case "calculo":
            $datos=$compra->get_compra_calculo($_POST["compr_id"]);
            foreach($datos as $row){
                $output["COMPR_SUBTOTAL"] = $row["COMPR_SUBTOTAL"];
                $output["COMPR_IVA"] = $row["COMPR_IVA"];
                $output["COMPR_TOTAL"] = $row["COMPR_TOTAL"];
            }
            echo json_encode($output);
            break;

        case "eliminardetalle":
            $compra->delete_compra_detalle($_POST["detc_id"]);
            break;

        case "listardetalle":
            $datos=$compra->get_compra_detalle($_POST["compr_id"]);
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
                $sub_array[] = $row["PROD_PCOMPRA"];
                $sub_array[] = $row["DETC_CANT"];
                $sub_array[] = $row["DETC_TOTAL"];
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["DETC_ID"].','.$row["COMPR_ID"].')" id="'.$row["DETC_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
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
            $datos=$compra->get_compra_detalle($_POST["compr_id"]);
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
                        <td><?php echo $row["PROD_PCOMPRA"];?></td>
                        <td><?php echo $row["DETC_CANT"];?></td>
                        <td class="text-end"><?php echo $row["DETC_TOTAL"];?></td>
                    </tr>
                <?php
            }
            break;

        case "guardar":
            $datos=$compra->update_compra(
                $_POST["compr_id"],
                $_POST["pag_id"],
                $_POST["prov_id"],
                $_POST["prov_ruc"],
                $_POST["prov_direcc"],
                $_POST["prov_correo"],
                $_POST["compr_coment"],
                $_POST["mon_id"],
                $_POST["doc_id"]
            );
            break;

        case "mostrar":
            $datos=$compra->get_compra($_POST["compr_id"]);
            foreach($datos as $row){
                $output["COMPR_ID"] = $row["COMPR_ID"];
                $output["SUC_ID"] = $row["SUC_ID"];
                $output["PAG_ID"] = $row["PAG_ID"];
                $output["PAG_NOM"] = $row["PAG_NOM"];
                $output["PROV_ID"] = $row["PROV_ID"];
                $output["PROV_RUC"] = $row["PROV_RUC"];
                $output["PROV_DIRECC"] = $row["PROV_DIRECC"];
                $output["PROV_CORREO"] = $row["PROV_CORREO"];
                $output["COMPR_SUBTOTAL"] = $row["COMPR_SUBTOTAL"];
                $output["COMPR_IVA"] = $row["COMPR_IVA"];
                $output["COMPR_TOTAL"] = $row["COMPR_TOTAL"];
                $output["COMPR_COMENT"] = $row["COMPR_COMENT"];
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
                $output["PROV_NOM"] = $row["PROV_NOM"];
            }
            echo json_encode($output);
            break;

        case "listarcompra":
            $datos=$compra->get_compra_listado($_POST["suc_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = "C-".$row["COMPR_ID"];
                $sub_array[] = $row["DOC_NOM"];
                $sub_array[] = $row["PROV_RUC"];
                $sub_array[] = $row["PROV_NOM"];
                $sub_array[] = $row["PAG_NOM"];
                $sub_array[] = $row["MON_NOM"];
                $sub_array[] = $row["COMPR_SUBTOTAL"];
                $sub_array[] = $row["COMPR_IVA"];
                $sub_array[] = $row["COMPR_TOTAL"];
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
                $sub_array[] = '<a href="../ViewCompra/?c='.$row["COMPR_ID"].'" target="_blank" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-printer-line"></i></a>';
                $sub_array[] = '<button type="button" onClick="ver('.$row["COMPR_ID"].')" id="'.$row["COMPR_ID"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="ri-settings-2-line"></i></button>';
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