var usu_id = $('#USU_IDx').val();


$(document).on("click","#btnguardar", function(){
    var pass = $("#txtpass").val();
    var newpass = $("#txtpassconfirm").val();

    if (pass.length== 0 || newpass.lenght == 0){
        swal.fire({
            title:'Error',
            text: 'Campos Vacios',
            icon: 'error'
        });
    }else{
        if(pass == newpass){
            $.post("../../controller/usuario.php?op=actualizar",{usu_id:usu_id,usu_pass:newpass},function(data){

            });

            swal.fire({
                title:'Correcto!',
                text: 'Actualizado Correctamente',
                icon: 'success'
            });
        }else{
            swal.fire({
                title:'Error',
                text: 'La contraseña no coinciden',
                icon: 'error'
            });
        }
    }
});