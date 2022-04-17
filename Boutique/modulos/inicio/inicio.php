<?php

require_once "../../class/Venta.php";
require_once "../../class/Producto.php";
require_once "../../class/Empleado.php";
require_once "../../configuracionSesionUsuario.php";



require_once "../../class/Sexo.php";



$listadoSexo = Sexo::obtenerTodos();

require_once "../../class/Proveedor.php";

if (isset($_GET["cboFiltroEstado"])) {
    $filtroEstado = $_GET["cboFiltroEstado"];
} else {
    $filtroEstado = 1; // ACTIVOS
}



if($usuario->perfil->getIdPerfil() == 1 || $usuario->perfil->getIdPerfil() == 2){


    if($usuario->perfil->getIdPerfil() == 1){

        $año= strftime("%Y");;
        $lista = Venta::obtenerVentasPorMeses($año);
        $listaVentasCategoria = Venta::obtenerTodosMasPorCategoria();
        $VentasDelDia = Venta::obtenerVentasPorDia();
        $pedidosPendientes= Venta::obtenerPedidosPendientes();
        $ventasPromedioMensual= Venta::obtenerPromedioVentas($año);
        $ventasDelMes= Venta::obtenerVentasDelMes();
        $ventasPresenciales= Venta::obtenerVentasPresensiales();
        $ventasVirtuales= Venta::obtenerVentasVirtuales();

    } elseif($usuario->perfil->getIdPerfil() == 2){
        $año= strftime("%Y");
        $idPersona = $usuario->getIdPersona();
        $empleado = Empleado::obtenerPorIdPersona($idPersona);
        $id_empleado= $empleado->getIdEmpleado();

        $lista = Venta::obtenerVentasPorMesesEmpleado($año,$id_empleado);
        $listaVentasCategoria = Venta::obtenerTodosMasPorCategoria();
        $VentasDelDia = Venta::obtenerVentasPorDiaEmpleado($id_empleado);
        $pedidosPendientes= Venta::obtenerPedidosPendientes();
        $ventasPromedioMensual= Venta::obtenerPromedioVentasEmpleado($año,$id_empleado);
        $ventasDelMes= Venta::obtenerVentasDelMesEmpleado($id_empleado);
        $ventasPresenciales= Venta::obtenerVentasPresensiales();
        $ventasVirtuales= Venta::obtenerVentasVirtuales();


    }
// Ventas Presensiales

    $cantidadVentasPresensiales= $ventasPresenciales->getCantidad();
    $porcentajeVentasPresenciales= 0;

// Ventas Virtuales
    $cantidadVentasVirtuales= $ventasVirtuales->getCantidad();
    $porcentajeVentasVirtuales = 0;

    $totalAmbasVentas= $cantidadVentasPresensiales + $cantidadVentasVirtuales;
    
    if ( $cantidadVentasPresensiales != 0 || $cantidadVentasVirtuales != 0 ){
            $porcentajeVentasPresenciales= ($cantidadVentasPresensiales * 100)/$totalAmbasVentas;
            $porcentajeVentasVirtuales= ($cantidadVentasVirtuales * 100)/$totalAmbasVentas;
    }
    

//
    $cantidadDeVentasDelMes= $ventasDelMes->getCantidad();
    $totalDeVentasDelMes= $ventasDelMes->getTotal();

    $cantidadDeVentasMensual= $ventasPromedioMensual->getCantidad();

    $totalAcumuladoMensual= $ventasPromedioMensual->getTotal();
    $dataPoints3 = [];
    $dataPoints3[]= array("label"=>"Presensial", "y"=>$porcentajeVentasPresenciales);
    $dataPoints3[]= array("label"=>"Pagina Web", "y"=>$porcentajeVentasVirtuales);
  //               


    $cantidadPedidosPendientes= count($pedidosPendientes);

    $cantidadDeVentas= $VentasDelDia->getCantidad();
    $totalAcumulado= $VentasDelDia->getTotal();
    if( empty($cantidadDeVentas)){
        $cantidadDeVentas = 0;
        $totalAcumulado = 0;

    } ;
//
    $dataPoints = [];
    foreach($lista as $venta){

        $dataPoints[]= array("label"=>$venta->getMes(), "y"=>$venta->getTotal());
    }

    $dataPoints2 = [];
    $totalVentasCategorias=0;
    foreach($listaVentasCategoria as $ventaCategoria){
        $totalVentasCategorias= $totalVentasCategorias +  $ventaCategoria->getTotal();
    }
    foreach($listaVentasCategoria as $ventaCategoria){
        $porcentajeCategoria= ($ventaCategoria->getTotal() * 100)/$totalVentasCategorias;
        $dataPoints2[]= array("label"=>$ventaCategoria->getMes(), "y"=>$porcentajeCategoria);
    }


}


?>
<?php


$mensaje = "";
$mensaje1 = "";
$mensaje2 = "";

if (isset($_GET["error"])) {
    // code...
    switch ($_GET["error"]) {


    // Validacion Mi Perfil lado del Servidos

        case 'nombreUsuarioModificar':
        $mensaje2 = "<div class='error'>"."El nombre del Usuario solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio."."</div>";
        break;

        case 'apellidoUsuarioModificar':
        $mensaje2 = "<div class='error'>"."El apellido del Usuario solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio."."</div>";
        break;
        case 'dniUsuarioModificar':
        $mensaje2 = "<div class='error'>"."El DNI del usuario tiene que ser de 8 a 11 dígitos y solo puede contener numeros."."</div>";
        break;
        case 'nacionalidadUsuarioModificar':
        $mensaje2 = "<div class='error'>"."La nacionalidad del usuario solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio."."</div>";
        break;
        case 'usernameUsuarioModificar':
        $mensaje2 = "<div class='error'>"."El usuario es obligatorio"."</div>";
        break;
        case 'passwordUsuarioModificar':
        $mensaje2 = "<div class='error'>"."La contraseña es obligatoria"."</div>";
        break;
        case 'imagenUsuarioModificar':
        $mensaje2 = "<div class='error'>"."La imagen debe ser jpg o png"."</div>";
        break;

    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/programacion_3/boutique/css/styleDashboard.css"> 
    <script src="/programacion_3/boutique/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../js/canvas.js"></script>
    <!-- Validaciones JS -->
    <script src="../../js/formularioProveedores.js"></script>
    <script src="../../js/formularioProveedoresNuevo.js"></script>
    <script src="../../js/formularioMiPerfil.js"></script>
    <!-- datatables JS -->
    <script type="text/javascript" src="/programacion_3/boutique/datatables/datatables.min.js"></script>    

    <!-- para usar botones en datatables JS -->  
    <script src="/programacion_3/boutique/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="/programacion_3/boutique/datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="/programacion_3/boutique/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="/programacion_3/boutique/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="/programacion_3/boutique/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="/programacion_3/boutique/datatables/datatables.min.css"/>


   
    <link rel="stylesheet" href="../../css/botonesNUEVO.css">
    <link rel="stylesheet" href="../../css/modalNUEVO.css"> 
    <link rel="stylesheet" href="../../css/formularioNUEVO.css">
    <link rel="stylesheet" href="../../css/formularioDinamico.css">

    <!--========== FORMULARIO DINAMICO ==========-->
    <script src="../../js/formularioDinamico.js"></script>
    
    <!--========== FONTAWESOME ICONS ==========-->
    <link rel="stylesheet" href="/programacion_3/boutique/css/all.min.css">

    <!--========== CSS ==========-->
    <link rel="stylesheet" href="/programacion_3/boutique/css/MenuHeaderFooter.css">
    <link rel="stylesheet" href="/programacion_3/boutique/css/MenuConfiguracion.css">
    <link rel="shortcut icon" href="/programacion_3/boutique/img/logo.ico">
    <script src="../../js/ventanaModal.js" ></script>

    <!--========== menuPerfil flecha arriba y abajo y desplegue de menu perfil ==========-->
    <script src="../../js/menuPerfilFlechas.js"></script>
    <!--========== Menu Configuracion y llamada a data table==========-->
    <script src="../../js/menuConfiguracionDatatable.js"></script>
    <script src="../../js/cargarImagenPerfil.js" ></script>
    <script>
        <?php if($usuario->perfil->getIdPerfil() == 1 || $usuario->perfil->getIdPerfil() == 2){ ?>
            window.onload = function() {

                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    title: {

                    },
                    data: [{
                        type: "column",
                        startAngle: 240,
                        yValueFormatString: "$##0.00",
                        indexLabel: "{y}",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                <?php  if($usuario->getIdPerfil() == 1){  ?>
                    var chart2 = new CanvasJS.Chart("chartContainer2", {
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    exportEnabled: true,
    animationEnabled: true,
    title: {

    },
    data: [{
        type: "pie",
        startAngle: 25,
        toolTipContent: "<b>{label}</b>: {y}%",
        yValueFormatString: "##0.00",
        showInLegend: "true",
        legendText: "{label}",
        indexLabelFontSize: 16,
        indexLabel: "{label} - {y}%",
        dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
    }]
});
                    var chart3 = new CanvasJS.Chart("chartContainer3", {
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    exportEnabled: true,
    animationEnabled: true,
    title: {

    },
    data: [{
        type: "pie",
        startAngle: 25,
        toolTipContent: "<b>{label}</b>: {y}%",
        yValueFormatString: "##0.00",
        showInLegend: "true",
        legendText: "{label}",
        indexLabelFontSize: 16,
        indexLabel: "{label} - {y}%",
        dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
    }]
});
                    chart3.render();
                    chart2.render();

                <?php } ?>
                chart.render();

            }
        <?php } ?>

        
    </script>


    <title>Inicio</title>
</head>
<body>
    <!--========== HEADER ==========-->
    <header class="header">
        <div class="header__container">
            <button class="btnVolver"type="button" onClick="history.go(-1);"><i class="botonGeneral fas fa-reply"></i></button>

            <div class="nombreModulo">

                <span id="modulo">inicio</span>
            </div>
            
            <span id="nombreDeUsuario"><?php echo $usuario->getNombre(); echo " "; echo $usuario->getApellido(); ?></span>
            <span id="nombreDePerfil"><?php echo $usuario->perfil->getDescripcion(); ?></span>


            <img id="perfil" onclick="showMenu(event)" onblur="hideMenu()" src="/programacion_3/boutique/modulos/miPerfil/<?php echo $usuario->getImagen(); ?>" alt="" class="header__img">
            <i id="flechaPerfil" class='fa fa-chevron-up rotate'></i>
            <div id="menu" class="menuPerfil">
                <a href="javascript:;" id="abrir3" onclick="abrirModal(this.id);validarMiPerfil();" ><i class='fas fa-user-circle nav__icon'  ></i><span id="perfilDetalle">Mi Perfil</span></a>
                <a href="/programacion_3/boutique/cerrar_sesion.php"><i class='fa fa-sign-out-alt nav__icon' ></i><span id="CerrarSesion">Cerrar Sesion</span></a>

            </div>



            <div class="header__logoIVO">
                <img id="logo" src="/programacion_3/boutique/img/logo2.png">
                <a href="/programacion_3/boutique/inicio.php" class="header__logoPalabra">IVO SYSTEM</a>

            </div>




        </div>
    </header>

    <!--========== NAV ==========-->
    <div class="nav" id="navbar">
        <nav class="nav__container">
            <div>
                <a href="/programacion_3/boutique/inicio.php" class="nav__link nav__logo">
                    <i class='fas fa-bars nav__icon' ></i>
                    <span class="nav__logo-name">Menu</span>
                </a>

                <div class="nav__list">
                    <div class="nav__items">

                        <a href="/programacion_3/boutique/modulos/inicio/inicio.php" class="nav__link active">
                            <i class='fas fa-home nav__icon' ></i>
                            <span class="nav__name">Inicio</span>
                        </a>

                        <?php foreach ($listadoModulos as $modulo): ?>
                            <?php if ($modulo->getNivel() == 1) { ?>

                                <div class="nav__dropdown">
                                    <a href="/programacion_3/boutique/modulos/<?php echo $modulo->getDirectorio(); ?>/listado.php" class="nav__link">
                                        <i class='<?php echo $modulo->getIcono(); ?> nav__icon' ></i>
                                        <span class="nav__name"><?php echo $modulo->getDescripcion(); ?></span>
                                        <?php foreach ($listadoModulos as $moduloIcono): ?>
                                           <?php if ($modulo->getIdModulo() == $moduloIcono->getHijoDe() ) { ?>
                                            <i class='fas fa-chevron-up nav__icon nav__dropdown-icon'></i>
                                            <?php break; ?>
                                        <?php } ?>
                                    <?php endforeach ?>
                                </a>


                                <div class="nav__dropdown-collapse">
                                    <?php foreach ($listadoModulos as $modulo2): ?>

                                        <?php  if ($modulo2->getNivel() == 2) { 
                                            if ($modulo->getIdModulo() == $modulo2->getHijoDe()) {?>
                                                <div class="nav__dropdown-content">

                                                    <a href="/programacion_3/boutique/modulos/<?php echo $modulo2->getDirectorio(); ?>/listado.php" class="nav__dropdown-item">
                                                        <i class='<?php echo $modulo2->getIcono(); ?>' ></i>
                                                        <span><?php echo $modulo2->getDescripcion(); ?></span>
                                                    </a>

                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php endforeach ?>
                                </div>

                            </div>

                        <?php } ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </nav>
</div>

<!--========== CONTENTS ==========-->
<main>
    <section>
        <?php  if($usuario->getIdPerfil() == 1 || $usuario->getIdPerfil() == 2 ){  ?>
            <div class="contenedorDashboardSuperior">
                <div id="primerDiv">
                    <i class="fas fa-shopping-cart" style=" font-size: 48px;color: #FFFFFF;margin:20px 5px;"></i>
                    <h5 id="tituloContenedor">Ventas del Dia</h5>
                    <p id="mostrarPrimero"><?php echo $cantidadDeVentas; ?></p>

                    <p id="mostrarSegundo"><strong> Total:</strong>$<?php echo $totalAcumulado; ?></p>
                </div>
                <div id="segundoDiv">
                    <i class="fas fa-shopping-bag" style=" font-size: 48px;color: #FFFFFF;margin:20px 5px;"></i>
                    <h5 id="tituloContenedorDos">Pedidos Pendientes</h5>
                    <p id="mostrarPrimeroDos"><?php echo $cantidadPedidosPendientes; ?></p>
                </div>
                <div id="tercerDiv">
                   <i class="fas fa-cart-plus" style=" font-size: 48px;color: #FFFFFF;margin:20px 5px;"></i>
                   <h5 id="tituloContenedorTres">Ventas Del Mes</h5>
                   <p id="mostrarPrimeroTres"><?php echo round($cantidadDeVentasDelMes); ?></p>

                   <p id="mostrarSegundoTres"><strong> Total:</strong>$<?php echo round($totalDeVentasDelMes); ?></p>

               </div>
               <div id="cuartoDiv">
                <i class="fas fa-coins" style=" font-size: 48px;color: #FFFFFF;margin:20px 5px;"></i>
                <h5 id="tituloContenedor">Ventas del Año</h5>
                <p id="mostrarPrimero"><?php echo $cantidadDeVentasMensual; ?></p>
                <p id="mostrarSegundo"><strong> Total:</strong>$<?php echo  round($totalAcumuladoMensual); ?></p>
            </div>
        </div>





        <div style="height: 350px; width: 100%;border-spacing: 1px;
        border-collapse: collapse;
        border-radius: 15px;
        background-color: #ffffff;
        text-align: center;
        box-shadow: 20px 20px 20px 20px rgba(0, 0, 0, 0.15);">
        <h4>Ventas del año <?php echo $año; ?></h4>
        <div id="chartContainer" style="height: 100%; width: 100%; border-radius: 50px;"></div>
    </div>
    <br><br>
    <?php if($usuario->getIdPerfil() == 1){  ?>
        <div style="height: 300px; width: 50%;border-spacing: 1px;
        border-collapse: collapse;
        border-radius: 15px;
        background-color: #ffffff;
        text-align: center;
        box-shadow: 20px 20px 20px 20px rgba(0, 0, 0, 0.15);
        margin-bottom: 80px;">
        <h4>Porcentaje de Ventas Por Categorias</h4>
        <div id="chartContainer2" style="height: 300px; width: 100%;"></div>
    </div>
    <div style="height: 300px; width: 45%;border-spacing: 1px;
    border-collapse: collapse;
    border-radius: 15px;
    background-color: #ffffff;
    text-align: center;
    box-shadow: 20px 20px 20px 20px rgba(0, 0, 0, 0.15);
    margin-bottom: 80px;
    float: right;
    margin-top: -380px;">
    <h4 style="margin-top: 0px;">Porcentaje de Ventas Presensial y Virtual</h4>
    <div id="chartContainer3" style="height: 300px; width: 100%;"></div>
</div>


<?php } ?>

<?php } ?>
<br><br>
<br><br>

<div id="miModal" class="modal">
    <div class="flex" id="flex">
        <div class="contenido-modal">
            <div class="modal-header flex">
                <h2>Añadir Nuevo Proveedor</h2>
                <span class="close" id="close">&times;</span>
            </div>
            <?php echo $mensaje; ?>

            <div class="modal-body" id="modal-body">

            </div>

        </div>
    </div>
</div>



<!-- Ventana modal Modificar -->

<div id="miModal2" class="modal">
    <div class="flex" id="flex2">
        <div class="contenido-modal">
            <div class="modal-header flex">
                <h2>Modificar Proveedor</h2>
                <span class="close" id="close2">&times;</span>
            </div>
            <?php echo $mensaje1; ?>
            <div class="modal-body" id="modal-body1">


            </div>

        </div>
    </div>
</div>

<!-- Ventana modal eliminar -->

<div id="miModal4" class="modal">
    <div class="flex" id="flex4">
        <div class="contenido-modal">
            <div class="modal-header flex">
                <h2>Eliminar Proveedor</h2>
                <span class="close" id="close4">&times;</span>
            </div>
            <div class="modal-body" id="modal-body2">

                <h1 class="eliminarRegistro">¿Esta seguro que desea eliminar el registro?</h1>
                <button type="cancel" name="Cancelar" class="botonCancelar"  onclick="window.location='/programacion_3/boutique/modulos/proveedores/listado.php';return false;">Cancelar</button>

                <input type="submit" name="Guardar" id="eliminar" value="Confirmar"  class="botonGuardar">
                <br><br>
            </div>

        </div>
    </div>
</div>


<!-- Ventana modal Mi Perfil -->

<div id="miModal3" class="modal">
    <div class="flex" id="flex3">
        <div class="contenido-modal">
            <div class="modal-header flex">
                <h2>Mi Perfil</h2>
                <span class="close" id="close3">&times;</span>
            </div>
            <?php echo $mensaje2; ?>
            <div class="modal-body" id="modal-body3">
                <?php require_once "../miPerfil/miPerfil.php";?>
            </div>

        </div>
    </div>
</div>



<?php foreach ($listadoModulos as $modulo5): ?>
    <?php  if ($modulo5->getNivel() == 3) {

      ?>




      <!--========== Menu Configuracion ==========-->
      <div class="container">
        <div class="menu-toggle">
            <span class="fa fa-cog" onclick="menuConfiguracion(event)"></span>
        </div>

         <!--==========   <div class="menu-round">
                <div class="btn-app">
                    <div class="fa fa-twitter"></div>
                </div>
                
            </div> ==========-->


            <div class="menu-line">
                <?php foreach ($listadoModulos as $modulo4): ?>
                    <?php if ($modulo4->getNivel() == 3) { ?>

                        <div class="btn-app">

                            <a href="/programacion_3/boutique/modulos/<?php echo $modulo4->getDirectorio(); ?>/listado.php" class="<?php echo $modulo4->getIcono(); ?>"></a>   
                            <span><?php echo $modulo4->getDescripcion(); ?></span>
                        </div>

                    <?php } ?>
                <?php endforeach ?>
                
            </div>


        </div>
        <?php break; } ?>

    <?php endforeach ?>

</section>
</main>

<!--========== MAIN JS ==========-->
<!--========== <script src="js/main.js"></script> NO ES NECESARIO ==========-->

</body>
<footer class="footer">
    <div class="redes-container">
        <p id="textoFooter">Copyright © 2021 ISPRMM </p>
        <ul>
            <li><a href="#" class="facebook"><i  class="fab fa-facebook-square"></i></a></li>
            <li><a href="#" class="instagram"><i class="fab fa-instagram-square"></i></a></li>
            <li><a href="#" class="gmail"><i  class="fab fa-google-plus-square"></i></a></li>
            <li><a href="#" class="whatsapp"><i  class="fab fa-whatsapp-square"></i></a></li>

        </ul>
        <p id="textoFooter">Gauna Pablo Nicolas</p>
    </div>

</footer>
</html>

