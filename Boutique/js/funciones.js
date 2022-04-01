 
function validar() {
    var mensaje = "";

    //var nombre = document.getElementById("txtNombre").value;

    var nombreCategoria = document.getElementById("txtNombreCategoria").value;


     if (nombreCategoria.length < 3) {
        mensaje = "<font color='red'>error</font>";
    }


    var divMensaje = document.getElementById("divMensaje");
    //alert(divMensaje.innerHTML);

    divMensaje.innerHTML = mensaje;

} 