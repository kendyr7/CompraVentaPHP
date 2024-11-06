var emp_id = $('#EMP_IDx').val();
var suc_id = $('#SUC_IDx').val();
var usu_id = $('#USU_IDx').val();

$(document).ready(function(){

    $.post("../../controller/venta.php?op=registrar",{suc_id:suc_id,usu_id:usu_id},function(data){
        data=JSON.parse(data);
        $('#vent_id').val(data.VENT_ID);
    });

    $('#cli_id').select2();

    $('#cat_id').select2();

    $('#prod_id').select2();

    $('#pag_id').select2();

    $('#mon_id').select2();

    $('#doc_id').select2();

    $.post("../../controller/documento.php?op=combo",{doc_tipo:"Venta"},function(data){
        $("#doc_id").html(data);
    });

    $.post("../../controller/cliente.php?op=combo",{emp_id:emp_id},function(data){
        $("#cli_id").html(data);
    });

    $.post("../../controller/categoria.php?op=combo",{suc_id:suc_id},function(data){
        $("#cat_id").html(data);
    });

    $.post("../../controller/pago.php?op=combo",function(data){
        $("#pag_id").html(data);
    });

    $.post("../../controller/moneda.php?op=combo",{suc_id:suc_id},function(data){
        $("#mon_id").html(data);
    });

    $("#cli_id").change(function(){
        $("#cli_id").each(function(){
            cli_id = $(this).val();
            $.post("../../controller/cliente.php?op=mostrar",{cli_id:cli_id},function(data){
                data=JSON.parse(data);
                $('#cli_ruc').val(data.CLI_RUC);
                $('#cli_direcc').val(data.CLI_DIRECC);
                $('#cli_telf').val(data.CLI_TELF);
                $('#cli_correo').val(data.CLI_CORREO);
            });
        });
    });

    $("#cat_id").change(function(){
        $("#cat_id").each(function(){
            cat_id = $(this).val();

            $.post("../../controller/producto.php?op=combo",{cat_id:cat_id},function(data){
                $("#prod_id").html(data);
            });

        });
    });

    $("#prod_id").change(function(){
        $("#prod_id").each(function(){
            prod_id = $(this).val();

            $.post("../../controller/producto.php?op=mostrar",{prod_id:prod_id},function(data){
                data=JSON.parse(data);
                $('#prod_pventa').val(data.PROD_PVENTA);
                $('#prod_stock').val(data.PROD_STOCK);
                $('#und_nom').val(data.UND_NOM);
            });

        });
    });

});

$(document).on("click","#btnagregar",function(){
    var vent_id = $("#vent_id").val();
    var prod_id = $("#prod_id").val();
    var prod_pventa = $("#prod_pventa").val();
    var detv_cant = $("#detv_cant").val();

    if($("#prod_id").val()=='' || $("#prod_pventa").val()=='' || $("#detv_cant").val()=='' ){

        swal.fire({
            title:'Venta',
            text: 'Error Campos Vacios',
            icon: 'error'
        });

    }else{

        $.post("../../controller/venta.php?op=guardardetalle",{
            vent_id:vent_id,
            prod_id:prod_id,
            prod_pventa:prod_pventa,
            detv_cant:detv_cant
        },function(data){
            console.log(data);
        });

        $.post("../../controller/venta.php?op=calculo",{vent_id:vent_id},function(data){
            data=JSON.parse(data);
            $('#txtsubtotal').html(data.VENT_SUBTOTAL);
            $('#txtiva').html(data.VENT_IVA);
            $('#txttotal').html(data.VENT_TOTAL);
        });

        $("#prod_pventa").val('');
        $("#detv_cant").val('');

        listar(vent_id);

    }

});

function eliminar(detv_id,vent_id){

    swal.fire({
        title:"Eliminar!",
        text:"Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText : "Si",
        showCancelButton : true,
        cancelButtonText: "No",
    }).then((result)=>{
        if (result.value){
            $.post("../../controller/venta.php?op=eliminardetalle",{detv_id:detv_id},function(data){
                console.log(data);
            });

            $.post("../../controller/venta.php?op=calculo",{vent_id:vent_id},function(data){
                data=JSON.parse(data);
                $('#txtsubtotal').html(data.VENT_SUBTOTAL);
                $('#txtiva').html(data.VENT_IVA);
                $('#txttotal').html(data.VENT_TOTAL);
            });

            listar(vent_id);

            swal.fire({
                title:'Venta',
                text: 'Registro Eliminado',
                icon: 'success'
            });
        }
    });

}

function listar(vent_id){
    $('#table_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"../../controller/venta.php?op=listardetalle",
            type:"post",
            data:{vent_id:vent_id}
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
}

$(document).on("click","#btnguardar",function(){
    var vent_id = $("#vent_id").val();
    var doc_id = $("#doc_id").val();
    var pag_id = $("#pag_id").val();
    var cli_id = $("#cli_id").val();
    var cli_ruc = $("#cli_ruc").val();
    var cli_direcc = $("#cli_direcc").val();
    var cli_correo = $("#cli_correo").val();
    var vent_coment = $("#vent_coment").val();
    var mon_id = $("#mon_id").val();

    if($("#doc_id").val()=='0' || $("#pag_id").val()=='0' || $("#cli_id").val()=='0' || $("#mon_id").val()=='0'){
        /* TODO:Validacion de Pago , Proveedor , Moneda */
        swal.fire({
            title:'Venta',
            text: 'Error Campos Vacios',
            icon: 'error'
        });

    }else{
        $.post("../../controller/venta.php?op=calculo",{vent_id:vent_id},function(data){
            data=JSON.parse(data);
            console.log(data);
            if (data.VENT_TOTAL==null){
                /* TODO:Validacion de Detalle */
                swal.fire({
                    title:'Venta',
                    text: 'Error No Existe Detalle',
                    icon: 'error'
                });

            }else{
                $.post("../../controller/venta.php?op=guardar",{
                    vent_id:vent_id,
                    pag_id:pag_id,
                    cli_id:cli_id,
                    cli_ruc:cli_ruc,
                    cli_direcc:cli_direcc,
                    cli_correo:cli_correo,
                    vent_coment:vent_coment,
                    mon_id:mon_id,
                    doc_id:doc_id
                },function(data){
                    console.log(data);
                    swal.fire({
                        title:'Venta',
                        text: 'Venta registrada Correctamente con Nro: V-'+vent_id,
                        icon: 'success',
                        footer: "<a href='../ViewVenta/?v="+vent_id+"' target='_blank'>Desea ver el Documento?</a>"
                    });

                });
            }

        });

    }

});

$(document).on("click","#btnlimpiar",function(){
    location.reload();
});