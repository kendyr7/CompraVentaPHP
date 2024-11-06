$(document).ready(function(){
    var compr_id = getUrlParameter('c');

    $.post("../../controller/compra.php?op=mostrar",{compr_id:compr_id},function(data){
        data=JSON.parse(data);
        $('#txtdirecc').html(data.EMP_DIRECC);
        $('#txtruc').html(data.EMP_RUC);
        $('#txtemail').html(data.EMP_CORREO);
        $('#txtweb').html(data.EMP_PAG);
        $('#txttelf').html(data.EMP_TELF);

        $('#compr_id').html(data.COMPR_ID);
        $('#fech_crea').html(data.FECH_CREA);
        $('#pag_nom').html(data.PAG_NOM);
        $('#txttotal').html(data.COMPR_TOTAL);

        $('#compr_subtotal').html(data.COMPR_SUBTOTAL);
        $('#compr_iva').html(data.COMPR_IVA);
        $('#compr_total').html(data.COMPR_TOTAL);

        $('#compr_coment').html(data.COMPR_COMENT);

        $('#usu_nom').html(data.USU_NOM +' '+ data.USU_APE);
        $('#mon_nom').html(data.MON_NOM);

        $('#prov_nom').html("<b>Nombre: </b>"+data.PROV_NOM);
        $('#prov_ruc').html("<b>RUC: </b>"+data.PROV_RUC);
        $('#prov_direcc').html("<b>Dirección: </b>"+data.PROV_DIRECC);
        $('#prov_correo').html("<b>Correo: </b>"+data.PROV_CORREO);

    });

    $.post("../../controller/compra.php?op=listardetalleformato",{compr_id:compr_id},function(data){
        $('#listdetalle').html(data);
    });

});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};