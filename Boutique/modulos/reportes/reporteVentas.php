


<?php

require_once "../../configuracionSesionUsuario.php";



require_once "../../class/Sexo.php";
require_once "../../class/Empleado.php";
require_once "../../class/Cliente.php";

require_once "../../class/Categoria.php";
require_once "../../class/Empleado.php";
$listadoEmpleados= Empleado::obtenerTodosActivos();
$listadoClientes= Cliente::obtenerTodosActivos();
$listadoCategoria = Categoria::obtenerTodosActivos();

$listadoSexo = Sexo::obtenerTodos();





if (!isset($_GET['txtFechaDesde'])) {
    $fechaDesde = "";
}else{
    $fechaDesde = $_GET['txtFechaDesde'];
}

if (!isset($_GET['txtFechaHasta'])) {
    $fechaHasta = "";
}else {
    $fechaHasta = $_GET['txtFechaHasta'];
}

if (!isset($_GET['Empleado'])) {
    $Empleado = 0;
} else {
    $Empleado = $_GET['Empleado'];
}

if (!isset($_GET['Cliente'])) {
    $Cliente = 0;
} else {
    $Cliente = $_GET['Cliente'];
}


require_once "../../class/Venta.php";
require_once "../../class/DetalleVenta.php";
$año= strftime("%Y");;
$lista = Venta::obtenerTodos($Empleado,$Cliente, $fechaDesde,$fechaHasta );
$ventasDelAño = Venta::obtenerVentasPorMeses($año);
$ventasDelMes = Venta::obtenerVentasPorMesActual();
$ventasDeLaSemana = Venta::obtenerVentasPorSemanaActual();
$ventasDelDia = Venta::obtenerVentasPorDiaActual();

$dataPoints = [];
foreach($ventasDelAño as $venta){

    $dataPoints[]= array("label"=>$venta->getMes(), "y"=>$venta->getTotal());
}
$dataPoints2 = [];
$semana=0;
foreach($ventasDelMes as $ventaMes){
    if($semana < $ventaMes->getSemana()){
        $semana = $ventaMes->getSemana();
    }
    }
foreach($ventasDelMes as $ventaMes){

    $diaInicio =date("d", strtotime($ventaMes->getFechaInicio()));
    $diaFin =date("d", strtotime($ventaMes->getFechaFin()));
    $ultimoDia =date("d", strtotime($ventaMes->getUltimoDia()));


    if($semana == $ventaMes->getSemana()){
        $diaFin = date("d", strtotime($ventaMes->getUltimoDia()));
        
    }if ($ventaMes->getSemana() == 1) {
        $diaInicio= 1;
    }
    $dataPoints2[]= array("label"=>"Dias ".$diaInicio." al ".$diaFin, "y"=>$ventaMes->getTotal());
}
$dataPoints3 = [];

foreach($ventasDeLaSemana as $ventaSemana){
    if($ventaSemana->getDia() == 1){
        $dia = "Domingo";
    }elseif($ventaSemana->getDia() ==2){
        $dia = "Lunes";
    }elseif($ventaSemana->getDia()== 3){
        $dia = "Martes";
    }elseif($ventaSemana->getDia()== 4){
        $dia = "Miercoles";
    }elseif($ventaSemana->getDia() ==5){
        $dia = "Jueves";
    }elseif($ventaSemana->getDia()== 6){
        $dia = "Viernes";
    }elseif($ventaSemana->getDia()== 7){
        $dia = "Sabado";
    };

    $dataPoints3[]= array("label"=>$dia, "y"=>$ventaSemana->getTotal());
}

$dataPoints4 = [];
foreach($ventasDelDia as $ventaDelDia){
   

    $dataPoints4[]= array("label"=>$ventaDelDia->empleado->getNombre()."".$ventaDelDia->empleado->getApellido(), "y"=>$ventaDelDia->getTotal());
}


?>
<?php


$mensaje = "";
$mensaje1 = "";
$mensaje2 = "";

if (isset($_GET["error"])) {
    // code...
    switch ($_GET["error"]) {

    case 'nombreProveedorAñadir':
        $mensaje = "<div class='error'>"."El nombre del Proveedor solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio."."</div>";
        break;

    case 'cuitAñadir':
        $mensaje = "<div class='error'>"."El CUIT del Proveedor tiene que ser de 8 a 11 dígitos y solo puede contener numeros"."</div>";
        break;

    case 'nombreProveedorModificar':
        $mensaje1 = "<div class='error'>"."El nombre del Proveedor solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio."."</div>";
        break;

    case 'cuitModificar':
        $mensaje1 = "<div class='error'>"."El CUIT del Proveedor tiene que ser de 8 a 11 dígitos y solo puede contener numeros"."</div>";
        break;
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
        <title>Reporte de Ventas</title>
        <meta charset="UTF-8">
        <meta name="author" content="Nicolas Gauna">
        <meta name="description" content="Sistema de Control de Stock y ventas Online">
        <link rel="shortcut icon" href="/programacion_3/boutique/img/logo.ico">
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


        <link rel="stylesheet" href="../../css/tablaNUEVO.css">
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
        <script src="../../js/ventanaModal.js" ></script>

        <!--========== menuPerfil flecha arriba y abajo y desplegue de menu perfil ==========-->
        <script src="../../js/menuPerfilFlechas.js"></script>
        <!--========== Menu Configuracion y llamada a data table==========-->
        <script src="../../js/menuConfiguracionDatatable.js"></script>
        <script src="../../js/cargarImagenPerfil.js" ></script>
        <script src="../../js/funcionesReportes.js" ></script>
        <style type="text/css">
            table.dataTable.dataTable_width_auto {
  width: auto;
}
        </style>
        <script type="text/javascript">
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
var chart2 = new CanvasJS.Chart("chartContainer2", {
    animationEnabled: true,
    title: {
        
    },
    data: [{
        type: "column",
        startAngle: 240,
        yValueFormatString: "$##0.00",
        indexLabel: "{y}",
        dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
    }]
});


var chart3 = new CanvasJS.Chart("chartContainer3", {
    animationEnabled: true,
    title: {
        
    },
    data: [{
        type: "column",
        startAngle: 240,
        yValueFormatString: "$##0.00",
        indexLabel: "{y}",
        dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
    }]
});
var chart4 = new CanvasJS.Chart("chartContainer4", {
    animationEnabled: true,
    title: {
        
    },
    data: [{
        type: "column",
        startAngle: 240,
        yValueFormatString: "$##0.00",
        indexLabel: "{y}",
        dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
    }]
});


chart.render();
chart2.render();
chart3.render();
chart4.render();

$("#buttonReporteAnual").on("click", function () {

  $("#chartContainer2").hide();
  $("#tituloMensual").hide();
  $("#tituloAnual").show();
  $("#tabla1").show();
    $("#tabla2").hide();
    $("#tabla3").hide();
    $("#tabla4").hide();
  $("#tituloSemanal").hide();
  $("#tituloDia").hide();
   $("#chartContainer").show();
   $("#chartContainer3").hide();
   $("#chartContainer4").hide();
  if( $("#chartContainer").css('display') === 'block')
    chart.render();
});

$("#buttonReporteMensual").on("click", function () {

  $("#chartContainer2").show();
  $("#tituloMensual").show();
  $("#tituloAnual").hide();
  $("#tituloSemanal").hide();
  $("#tituloDia").hide();
   $("#chartContainer").hide();
   $("#chartContainer3").hide();
   $("#chartContainer4").hide();
  $("#tabla1").hide();
    $("#tabla2").show();
    $("#tabla3").hide();
    $("#tabla4").hide();
  if( $("#chartContainer2").css('display') === 'block')
    chart2.render();
});


$("#buttonReporteSemanal").on("click", function () {

  $("#chartContainer2").hide();
  $("#tituloMensual").hide();
  $("#tituloAnual").hide();
  $("#tituloSemanal").show();
  $("#tituloDia").hide();
   $("#chartContainer").hide();
   $("#chartContainer3").show();
   $("#chartContainer4").hide();
    $("#tabla1").hide();
    $("#tabla2").hide();
    $("#tabla3").show();
    $("#tabla4").hide();
  if( $("#chartContainer3").css('display') === 'block')
    chart3.render();
});



$("#buttonReporteDia").on("click", function () {

  $("#chartContainer2").hide();
  $("#tituloMensual").hide();
  $("#tituloAnual").hide();
  $("#tituloSemanal").hide();
  $("#tituloDia").show();
   $("#chartContainer").hide();
   $("#chartContainer3").hide();
   $("#chartContainer4").show();
     $("#tabla1").hide();
    $("#tabla2").hide();
    $("#tabla3").hide();
    $("#tabla4").show();
  if( $("#chartContainer4").css('display') === 'block')
    chart4.render();
});


}



        </script>

    </head>
    <body>
        <!--========== HEADER ==========-->
        <header class="header">
            <div class="header__container">
                <button class="btnVolver"type="button" onClick="history.go(-1);"><i class="botonGeneral fas fa-reply"></i></button>

                <div class="nombreModulo">
                    <span id="abmModulo">Reporte de</span>
                    <span id="modulo">ventas</span>
                </div>
                
                <span id="nombreDeUsuario"><?php echo $usuario->getNombre(); echo " "; echo $usuario->getApellido(); ?></span>
                <span id="nombreDePerfil"><?php echo $usuario->perfil->getDescripcion(); ?></span>


                <img id="perfil" onclick="showMenu(event)" src="/programacion_3/boutique/modulos/miPerfil/<?php echo $usuario->getImagen(); ?>" alt="ImagenDePerfil" class="header__img">
                <i id="flechaPerfil" class='fa fa-chevron-up rotate'></i>
                <div id="menu" class="menuPerfil">
                    <a href="javascript:;" id="abrir3" onclick="abrirModal(this.id);validarMiPerfil();" >
                        <i class='fas fa-user-circle nav__icon'  ></i>
                        <span id="perfilDetalle">Mi Perfil</span>
                    </a>
                    <a href="/programacion_3/boutique/cerrar_sesion.php">
                        <i class='fa fa-sign-out-alt nav__icon' ></i>
                        <span id="CerrarSesion">Cerrar Sesion</span>
                    </a>

                </div>

                <div class="header__logoIVO">
                    <img id="logo" src="/programacion_3/boutique/img/logo2.png" alt="logoSistema">
                    <a href="/programacion_3/boutique/modulos/inicio/inicio.php" class="header__logoPalabra">IVO SYSTEM</a>
                </div>

            </div>
        </header>

        <!--========== NAV ==========-->
        <div class="nav" id="navbar">
            <nav class="nav__container">
                <div>
                    <a href="/programacion_3/boutique/modulos/inicio/inicio.php" class="nav__link nav__logo">
                        <i class='fas fa-bars nav__icon' ></i>
                        <span class="nav__logo-name">Menu</span>
                    </a>

                    <div class="nav__list">
                        <div class="nav__items">

                            <a href="/programacion_3/boutique/modulos/inicio/inicio.php" class="nav__link">
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

        <!--========== CONTENIDO ==========-->
        <main>
            <section id="contenedorPrincipal">
            <div style="margin-bottom:70px">
            <fieldset style="min-height:100px;">
            <legend><b> Reporte General </b> </legend>
             <div class="contenedorFormularoReportes">
                <button class="buttonReporteAnual" id="buttonReporteAnual">Reporte Anual</button>
                <button class="buttonReporteMensual" id="buttonReporteMensual" >Reporte del Mes</button>
                <button class="buttonReporteSemanal" id="buttonReporteSemanal">Reporte de la Semana</button>
                <button class="buttonReporteDia" id="buttonReporteDia">Reporte del dia</button>
            </div>

        <div class="contenedorGraficoPrincipal" id="graficoAnual" style="display: block;">
         
                <h4 id="tituloAnual">Grafico de Ventas Anual</h4>
                <div id="chartContainer"></div>
                <h4 id="tituloMensual" style="display: none">Grafico de Ventas Mensual</h4>
                <div id="chartContainer2"></div>
                <h4 id="tituloSemanal" style="display: none">Grafico de Ventas Semanal</h4>
                <div id="chartContainer3"></div> 
                <h4 id="tituloDia" style="display: none">Grafico de Ventas del Dia</h4>
                <div id="chartContainer4"></div>
                
        </div>
       
         <div id="tabla1">
            <table id="reporte1" class="styled-table" style="width:100%;" >
                <thead>
                    <th>Mes</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </thead>
                <tbody>
                     <?php foreach($ventasDelAño as $ventasDelAño){ ?>
                     <tr class="active-row">
                        <td><?php echo $ventasDelAño->getMes(); ?></td>
                        <td><?php echo $ventasDelAño->getCantidad(); ?></td>
                        <td>$<?php echo $ventasDelAño->getTotal(); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                
            </table>
            </div>
            <div id="tabla2" style="display: none;">
            <table id="reporte2" class="styled-table" style="width:100%;" >
                <thead>
                    <th>Semana</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </thead>
                <tbody>
                     <?php foreach($ventasDelMes as $ventasDelMes){ ?>
                     <tr class="active-row">
                        <td><?php echo $ventasDelMes->getSemana(); ?></td>
                        <td><?php echo $ventasDelMes->getFechaInicio(); ?></td>
                        <td><?php echo $ventasDelMes->getFechaFin(); ?></td>
                        <td><?php echo $ventasDelMes->getCantidad(); ?></td>
                        <td>$<?php echo $ventasDelMes->getTotal(); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                
            </table>
        </div>
        <div id="tabla3" style="display: none;">
            <table id="reporte3" class="styled-table" style="width:100%;" >
                <thead>
                    <th>Dia</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </thead>
                <tbody>
                   <?php foreach($ventasDeLaSemana as $ventasDeLaSemana){ ?>
                       <tr class="active-row">
                        <?php  if($ventasDeLaSemana->getDia() == 1){
                            $dia = "Domingo";
                        }elseif($ventasDeLaSemana->getDia() ==2){
                            $dia = "Lunes";
                        }elseif($ventasDeLaSemana->getDia()== 3){
                            $dia = "Martes";
                        }elseif($ventasDeLaSemana->getDia()== 4){
                            $dia = "Miercoles";
                        }elseif($ventasDeLaSemana->getDia() ==5){
                            $dia = "Jueves";
                        }elseif($ventasDeLaSemana->getDia()== 6){
                            $dia = "Viernes";
                        }elseif($ventasDeLaSemana->getDia()== 7){
                            $dia = "Sabado";
                        }; ?>
                        <td><?php echo $dia; ?></td>
                        <td><?php echo $ventasDeLaSemana->getCantidad(); ?></td>
                        <td>$<?php echo $ventasDeLaSemana->getTotal(); ?></td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
    <div id="tabla4" style="display: none;">
         <table id="reporte4" class="styled-table" style="width:100%;" >
                <thead>
                    <th>Vendedor</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </thead>
                <tbody>
                     <?php foreach($ventasDelDia as $ventasDelDia){ ?>
                     <tr class="active-row">
                        <td><?php echo $ventasDelDia->empleado->getNombre(); ?></td>
                        <td><?php echo $ventasDelDia->getCantidad(); ?></td>
                        <td>$<?php echo $ventasDelDia->getTotal(); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                
            </table>
            </div>
</fieldset>
</div>
   <div style="margin-bottom:70px">
    <fieldset style="min-height:100px;">
<legend><b> Reporte Detallado </b> </legend>

    <div class="contenedorFormularoReportes">
                <form method="GET" class="formularioEstadoReportes">
                   <label>Empleado: </label>    
                   <select name="Empleado" id="Empleado" >
                    <option value="NULL">---Seleccionar---</option>

                    <?php foreach ($listadoEmpleados as $empleado): ?>


                        <option value="<?php echo $empleado->getIdEmpleado(); ?>">
                            <?php echo $empleado->getNombre(); echo " ";
                            echo $empleado->getApellido(); echo " ";
                            echo $empleado->getDNI();?>
                        </option>
                    <?php endforeach ?>
                </select>
                <label>Cliente: </label>    
                   <select name="Cliente" id="Cliente" >
                    <option value="NULL">---Seleccionar---</option>

                    <?php foreach ($listadoClientes as $cliente): ?>


                        <option value="<?php echo $cliente->getIdCliente(); ?>">
                            <?php echo $cliente->getNombre(); echo " ";
                            echo $cliente->getApellido(); echo " ";
                            echo $cliente->getDNI();?>
                        </option>
                    <?php endforeach ?>
                </select>
                <label>Desde: </label>
                <input type="date" name="txtFechaDesde">

                <label>Hasta: </label>
                <input type="date" name="txtFechaHasta">


                <button type="submit" id="botonFiltrarVentas">Filtrar</button> 
            </form>
        </div>
        <div id="container" style="margin-top:100px; margin-bottom: 40px;">

            <table id="reporte5" class="styled-table" style="width:100%;" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Empleado</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Venta</th>
                        <th>Total</th>


                    </tr>

                </thead>
                <tbody>
                    <?php foreach($lista as $venta){ ?>
                        <tr class="active-row">
                            <td><?php echo $venta->getIdVenta(); ?></td>
                            <td><?php echo $venta->getFechaHora() ?></td>
                            <td><?php
                            $idEmpleado = $venta->getIdEmpleado();
                            if (empty($idEmpleado)){

                                echo "Pagina Web";
                            } else {
                                $empleado= Empleado::obtenerPorId($idEmpleado);
                                echo $empleado->getNombre();
                                echo "<br>";
                                echo $empleado->getApellido();

                            }

                        ?></td>
                        <td><?php echo $venta->cliente->getNombre();
                        echo "<br>";
                        echo $venta->cliente->getApellido();?></td>
                        <?php
                        $id_venta=  $venta->getIdVenta();
                        $listaDetalles = DetalleVenta::obtenerPorIdVenta($id_venta);


                        ?>
                        <td>

                          <?php  foreach($listaDetalles as $detalleVenta){ 
                            echo $detalleVenta->productoTalle->producto->getNombreProducto(); 
                            echo "<br>";
                        }
                        ?>


                    </td>
                    <td>
                     <?php  foreach($listaDetalles as $detalleVenta){ 
                        echo $detalleVenta->getCantidad(); 
                        echo "<br>";
                    }
                    ?>
                </td>
                <td>
                 <?php  foreach($listaDetalles as $detalleVenta){ 

                    echo "$".$detalleVenta->getPrecio(); 
                    echo "<br>";
                }
                ?>
            </td>



            



            <td><?php echo "$".$venta->getTotal() ?></td>

        </tr>
    <?php } ?>
</tbody>

<tfoot>
  
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><b>CANTIDAD DE VENTAS</b></td>
        <td> <?php echo count($lista, COUNT_RECURSIVE); ?> </td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><b>TOTAL FACTURADO</b></td>
        <td> <?php 
        $totalFinal= 0;
        foreach($lista as $totalVenta){
            $totalAcumular= $totalVenta->getTotal();
            $totalFinal= $totalFinal + $totalAcumular; }
            echo "$".$totalFinal;?> </td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</tfoot>
</table>
</div>

</fieldset>
</div>
<!-- Ventana modal Añadir -->

<div id="miModal" class="modal">
    <div class="flex" id="flex">
        <div class="contenido-modal">
            <div class="modal-header flex">
                <h2>Añadir Nueva Venta</h2>
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
                <h2>Modificar Venta</h2>
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
                <h2>Cancelar Venta</h2>
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
</body>

    <!--========== Footer ==========-->

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

