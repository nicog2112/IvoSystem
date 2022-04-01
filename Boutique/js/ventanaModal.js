function abrirModal(idClick,valor) 
{/* 1. Antes de trabajar con el DOM verifica que esté todo cargado*/

    var valor = valor;
    let modulo = document.getElementById("modulo").innerHTML; 

    if (idClick == 'abrir' ) {
        var modal = document.getElementById('miModal'); /* 2. Referencia única a los elementos NUEVO */
        var flex = document.getElementById('flex');
        var abrir = document.getElementById('abrir');
        var cerrar = document.getElementById('close');



        if (modulo == "proveedores"){
                $('#modal-body').load('/programacion_3/boutique/modulos/'+modulo+'/nuevo.php',validarFormularioNuevoProveedor);

        } else if (modulo == "preventistas" || modulo == "clientes") {
                 $('#modal-body').load('/programacion_3/boutique/modulos/'+modulo+'/nuevo.php?id='+valor);

        } else if (modulo == "domicilios") {
            var idPersona = document.getElementById("idPersonaModificar").value;
            var moduloMenu = document.getElementById("idModuloMenu").value;
             var idMenu = document.getElementById("idMenu").value;
   
            $('#modal-body').load('/programacion_3/boutique/modulos/'+modulo+'/nuevo.php?id='+idMenu+'&id_persona='+idPersona+'&modulo='+moduloMenu,selectAnidados);

        } else if (modulo == "contactos") {
           var idPersona = document.getElementById("idPersonaModificar").value;
            var moduloMenu = document.getElementById("idModuloMenu").value;
             var idMenu = document.getElementById("idMenu").value;
                 $('#modal-body').load('/programacion_3/boutique/modulos/'+modulo+'/nuevo.php?id='+idMenu+'&id_persona='+idPersona+'&modulo='+moduloMenu,validarContacto);

        }else if (modulo == "contactosProveedores") {
            var idProveedor = document.getElementById("idProveedorModificar").value;
            
                 $('#modal-body').load('/programacion_3/boutique/modulos/'+modulo+'/nuevo.php?id='+valor+'&id_proveedor='+idProveedor,validarContacto);

        }  else if (modulo == "domiciliosProveedores") {
            var idProveedor = document.getElementById("idProveedorModificar").value;
                 $('#modal-body').load('/programacion_3/boutique/modulos/'+modulo+'/nuevo.php?id='+valor+'&id_proveedor='+idProveedor,selectAnidados);

        } else if (modulo == "empleados") {

                $('#modal-body').load('/programacion_3/boutique/modulos/'+modulo+'/nuevo.php',validarPreventistaNuevo);

        } else if (modulo == "personas") {

                $('#modal-body').load('/programacion_3/boutique/modulos/persona/nuevo.php',validarPreventistaNuevo);

        } else if (modulo == "modulos") {

                $('#modal-body').load('/programacion_3/boutique/modulos/'+modulo+'/nuevo.php',validarModulosNuevo);
        } else if (modulo == "categorias") {

                $('#modal-body').load('/programacion_3/boutique/modulos/'+modulo+'/nuevo.php',validarDescripcionNuevo);
        } else if (modulo == "temporadas") {

                $('#modal-body').load('/programacion_3/boutique/modulos/'+modulo+'/nuevo.php',validarValorDescripcionNuevo);
        } else if (modulo == "productos") {

                $('#modal-body').load('/programacion_3/boutique/modulos/'+modulo+'/nuevo.php',validarProductoNuevo);
        } else if (modulo == "perfiles") {

                $('#modal-body').load('/programacion_3/boutique/modulos/'+modulo+'/nuevo.php',validarDescripcionNuevo);
        } else if (modulo == "pais") {

                $('#modal-body').load('/programacion_3/boutique/modulos/configuracionDomicilio/nuevo.php',validarDescripcionNuevo);
        } else if (modulo == "provincia") {

                $('#modal-body').load('/programacion_3/boutique/modulos/configuracionDomicilio/nuevoProvincia.php?id='+valor,validarDescripcionNuevo);
        } else if (modulo == "localidad") {

            $('#modal-body').load('/programacion_3/boutique/modulos/configuracionDomicilio/nuevoLocalidad.php?id='+valor,validarDescripcionNuevo);
        } else if (modulo == "barrio") {

            $('#modal-body').load('/programacion_3/boutique/modulos/configuracionDomicilio/nuevoBarrio.php?id='+valor,validarDescripcionNuevo);
        } else if (modulo == "tipo de contacto") {

                $('#modal-body').load('/programacion_3/boutique/modulos/tipoContacto/nuevo.php',validarDescripcionNuevo);

        } else if (modulo == "tipo de pago") {

                $('#modal-body').load('/programacion_3/boutique/modulos/tiposPagos/nuevo.php',validarValorDescripcionNuevo);

        } else if (modulo == "tipo de impuestos") {

                $('#modal-body').load('/programacion_3/boutique/modulos/tiposImpositivos/nuevo.php',validarValorDescripcionNuevo);

        } else if (modulo == "tipo de factura") {

                $('#modal-body').load('/programacion_3/boutique/modulos/tiposFacturas/nuevo.php',validarDescripcionNuevo);

        }   else if (modulo == "producto talle") {

                $('#modal-body').load('/programacion_3/boutique/modulos/productoTalle/nuevo.php?id='+valor,validarProductoTalleNuevo);

        } else if (modulo == "usuarios") {

                $('#modal-body').load('/programacion_3/boutique/modulos/usuarios/nuevo.php?id='+valor,validarNuevoUsuario);

        } else if (modulo == "pedidos") {
          
                $('#modal-body').load('/programacion_3/boutique/modulos/pedidos/generarFactura.php?id='+valor);

        } else if (modulo == "talles") {
          
                $('#modal-body').load('/programacion_3/boutique/modulos/talle/nuevo.php?id='+valor,validarDescripcionNuevo);

        }
    }
     else if (idClick == 'abrir2' ) {
        var modal = document.getElementById('miModal2'); /* 2. Referencia única a los elementos MODIFICAR*/
        var flex = document.getElementById('flex2');
        var abrir = document.getElementById('abrir2');
        var cerrar = document.getElementById('close2');

        if (modulo == "proveedores"){
      
          $('#modal-body1').load('/programacion_3/boutique/modulos/'+modulo+'/modificar.php?id='+valor,validarFormularioProveedor);

        } else if (modulo == "preventistas" || modulo == "clientes"){
             $('#modal-body1').load('/programacion_3/boutique/modulos/'+modulo+'/modificar.php?id='+valor,validarPreventistaModificar);

        } else if (modulo == "domicilios") {
            var idPersona = document.getElementById("idPersonaModificar").value;
             var moduloMenu = document.getElementById("idModuloMenu").value;
             var idMenu = document.getElementById("idMenu").value;
            
            $('#modal-body1').load('/programacion_3/boutique/modulos/'+modulo+'/modificar.php?id='+valor+'&id_persona='+idPersona+'&modulo='+moduloMenu+'&idMenu='+idMenu,selectAnidadosModificar);

        }else if (modulo == "contactos") {
            var idPersona = document.getElementById("idPersonaModificar").value;
             var moduloMenu = document.getElementById("idModuloMenu").value;
             var idMenu = document.getElementById("idMenu").value;
            
            $('#modal-body1').load('/programacion_3/boutique/modulos/'+modulo+'/modificar.php?id='+valor+'&id_persona='+idPersona+'&modulo='+moduloMenu+'&idMenu='+idMenu,validarContactoModificar);

        }  else if (modulo == "domiciliosProveedores") {
            var idProveedor = document.getElementById("idProveedorModificar").value;
            $('#modal-body1').load('/programacion_3/boutique/modulos/'+modulo+'/modificar.php?id='+valor+'&id_proveedor='+idProveedor,selectAnidadosModificar);

        }else if (modulo == "contactosProveedores") {
            var idProveedor = document.getElementById("idProveedorModificar").value;
            
            $('#modal-body1').load('/programacion_3/boutique/modulos/'+modulo+'/modificar.php?id='+valor+'&id_proveedor='+idProveedor,validarContactoModificar);

        }else if (modulo == "empleados") {
             $('#modal-body1').load('/programacion_3/boutique/modulos/'+modulo+'/modificar.php?id='+valor,validarPreventistaModificar);

        }else if (modulo == "personas") {
             $('#modal-body1').load('/programacion_3/boutique/modulos/persona/modificar.php?id='+valor,validarPreventistaModificar);

        }else if (modulo == "modulos") {
             $('#modal-body1').load('/programacion_3/boutique/modulos/'+modulo+'/modificar.php?id='+valor,validarModulosModificar);
        }else if (modulo == "categorias") {
             $('#modal-body1').load('/programacion_3/boutique/modulos/'+modulo+'/modificar.php?id='+valor,validarDescripcionModificar);
        }else if (modulo == "talles") {
             $('#modal-body1').load('/programacion_3/boutique/modulos/talle/modificar.php?id='+valor,validarDescripcionModificar);
        }
         else if (modulo == "temporadas") {
             $('#modal-body1').load('/programacion_3/boutique/modulos/'+modulo+'/modificar.php?id='+valor,validarValorDescripcionModificar);
        } else if (modulo == "productos") {
             $('#modal-body1').load('/programacion_3/boutique/modulos/'+modulo+'/modificar.php?id='+valor,validarProductoModificar);
        } else if (modulo == "perfiles") {
             $('#modal-body1').load('/programacion_3/boutique/modulos/'+modulo+'/modificar.php?id='+valor,validarDescripcionModificar);
        } else if (modulo == "pais") {
             $('#modal-body1').load('/programacion_3/boutique/modulos/configuracionDomicilio/modificar.php?id='+valor,validarDescripcionModificar);
        } else if (modulo == "provincia") {
            var idPais = document.getElementById("idPaisModificar").value;
             $('#modal-body1').load('/programacion_3/boutique/modulos/configuracionDomicilio/modificarProvincia.php?id='+valor+'&id_pais='+idPais,validarDescripcionModificar);
        } else if (modulo == "localidad") {
            var idProvincia = document.getElementById("idProvinciaModificar").value;
             $('#modal-body1').load('/programacion_3/boutique/modulos/configuracionDomicilio/modificarLocalidad.php?id='+valor+'&id_provincia='+idProvincia,validarDescripcionModificar);
        } else if (modulo == "barrio") {
            var idLocalidad = document.getElementById("idLocalidadModificar").value;
             $('#modal-body1').load('/programacion_3/boutique/modulos/configuracionDomicilio/modificarBarrio.php?id='+valor+'&id_localidad='+idLocalidad,validarDescripcionModificar);
        } else if (modulo == "tipo de contacto") {
            
             $('#modal-body1').load('/programacion_3/boutique/modulos/tipoContacto/modificar.php?id='+valor,validarDescripcionModificar);
        } else if (modulo == "tipo de pago") {
            
             $('#modal-body1').load('/programacion_3/boutique/modulos/tiposPagos/modificar.php?id='+valor,validarValorDescripcionModificar);
        } else if (modulo == "tipo de impuestos") {
            
             $('#modal-body1').load('/programacion_3/boutique/modulos/tiposImpositivos/modificar.php?id='+valor,validarValorDescripcionModificar);
        } else if (modulo == "tipo de factura") {
            
             $('#modal-body1').load('/programacion_3/boutique/modulos/tiposFacturas/modificar.php?id='+valor,validarDescripcionModificar);
        } else if (modulo == "producto talle") {
            var idProducto = document.getElementById("idProductoModificar").value;
             $('#modal-body1').load('/programacion_3/boutique/modulos/productoTalle/modificar.php?id='+valor+'&id_producto='+idProducto,validarProductoTalleModificar);
        } else if (modulo == "usuarios") {
            var idPerfilUsuario = document.getElementById("idPerfilUsuarioModificar").value;
             $('#modal-body1').load('/programacion_3/boutique/modulos/usuarios/modificar.php?id='+valor+'&id_perfil_usuario='+idPerfilUsuario,validarModificarUsuario);
        }

    } else if (idClick == 'abrir3' ) {
        var modal = document.getElementById('miModal3'); /* 2. Referencia única a los elementos MI PERFIL*/
        var flex = document.getElementById('flex3');
        var abrir = document.getElementById('abrir3');
        var cerrar = document.getElementById('close3');
      
   
    } else if (idClick == 'abrir4' ) {
        var modal = document.getElementById('miModal4'); /* 2. Referencia única a los elementos ELIMINAR*/
        var flex = document.getElementById('flex4');
        var abrir = document.getElementById('abrir4');
        var cerrar = document.getElementById('close4');
        
        if (modulo == "proveedores"){
            $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/'+modulo+'/eliminar.php?id='+valor;
            });
        }  else if (modulo == "preventistas"){
             var idProveedor = document.getElementById("idProveedorEliminar").value;
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/'+modulo+'/eliminar.php?id='+valor+'&id_proveedor='+idProveedor;
            });
         }  else if (modulo == "clientes"){
             
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/'+modulo+'/eliminar.php?id='+valor;
            });
         }else if (modulo == "empleados"){
             
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/'+modulo+'/eliminar.php?id='+valor;
            });
         }else if (modulo == "personas"){
             
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/persona/eliminar.php?id='+valor;
            });
         }else if (modulo == "categorias"){
             
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/'+modulo+'/eliminar.php?id='+valor;
            });
         }  else if (modulo == "temporadas"){
             
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/'+modulo+'/eliminar.php?id='+valor;
            });
         }  else if (modulo == "perfiles"){
             
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/'+modulo+'/eliminar.php?id='+valor;
            });
         } else if (modulo == "pais"){
             
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/configuracionDomicilio/eliminar.php?id='+valor;
            });
         } else if (modulo == "provincia"){
             var idPais = document.getElementById("idPaisModificar").value;
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/configuracionDomicilio/eliminarProvincia.php?id='+valor+'&id_pais='+idPais;
            });
         } else if (modulo == "localidad"){
             var idProvincia = document.getElementById("idProvinciaModificar").value;
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/configuracionDomicilio/eliminarLocalidad.php?id='+valor+'&id_provincia='+idProvincia;
            });
         } else if (modulo == "barrio"){
             var idLocalidad = document.getElementById("idLocalidadModificar").value;
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/configuracionDomicilio/eliminarBarrio.php?id='+valor+'&id_localidad='+idLocalidad;
            });
         } else if (modulo == "tipo de contacto"){
            
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/tipoContacto/eliminar.php?id='+valor;
            });
         } else if (modulo == "tipo de pago"){
            
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/tiposPagos/eliminar.php?id='+valor;
            });
         } else if (modulo == "talles"){
            
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/talle/eliminar.php?id='+valor;
            });
         } else if (modulo == "tipo de impuestos"){
            
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/tiposImpositivos/eliminar.php?id='+valor;
            });
         }  else if (modulo == "tipo de factura"){
            
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/tiposFacturas/eliminar.php?id='+valor;
            });
         } else if (modulo == "producto talle"){
             var idProducto = document.getElementById("idProductoModificar").value;
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/productoTalle/eliminar.php?id='+valor+'&id_producto='+idProducto;
            });
         } else if (modulo == "modulos"){
            
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/modulos/eliminar.php?id='+valor;
            }); 
             } else if (modulo == "usuarios"){
                var idPerfilUsuario = document.getElementById("idPerfilUsuarioModificar").value;
            
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/usuarios/eliminar.php?id='+valor+'&id_perfil_usuario='+idPerfilUsuario;
            }); 
             } else if (modulo == "domiciliosProveedores"){
                var idProveedor = document.getElementById("idProveedorModificar").value;
            
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/domiciliosProveedores/eliminar.php?id='+valor+'&id_proveedor='+idProveedor;
            }); 
             } else if (modulo == "contactosProveedores"){
                var idProveedor = document.getElementById("idProveedorModificar").value;
            
             $("#eliminar").click(function(){
                window.location.href = '/programacion_3/boutique/modulos/contactosProveedores/eliminar.php?id='+valor+'&id_proveedor='+idProveedor;
            }); 
             } else if (modulo == "contactos"){
                 var idPersona = document.getElementById("idPersonaModificar").value;
             var moduloMenu = document.getElementById("idModuloMenu").value;
             var idMenu = document.getElementById("idMenu").value;
            
             $("#eliminar").click(function(){

                window.location.href = '/programacion_3/boutique/modulos/contactos/eliminar.php?id='+valor+'&id_persona='+idPersona+'&modulo='+moduloMenu+'&idMenu='+idMenu;
            }); 
             } else if (modulo == "domicilios") {
            var idPersona = document.getElementById("idPersonaModificar").value;
             var moduloMenu = document.getElementById("idModuloMenu").value;
             var idMenu = document.getElementById("idMenu").value;
            

            $("#eliminar").click(function(){

                window.location.href = '/programacion_3/boutique/modulos/domicilios/eliminar.php?id='+valor+'&id_persona='+idPersona+'&modulo='+moduloMenu+'&idMenu='+idMenu;
            }); 
           
        }
    } else if (idClick == 'abrir5' ) {
        var modal = document.getElementById('miModal5'); /* 2. Referencia única a los elementos MI PERFIL*/
        var flex = document.getElementById('flex5');
        var abrir = document.getElementById('abrir5');
        var cerrar = document.getElementById('close5');
        
        $('#modal-body5').load('/programacion_3/boutique/modulos/perfiles/listadoModulos.php?id='+valor);
   
    }


   
    modal.style.display = 'block';


    cerrar.addEventListener('click', function(){
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(e){
        console.log(e.target);
        if(e.target == flex){
            modal.style.display = 'none';
        }
    });
};

