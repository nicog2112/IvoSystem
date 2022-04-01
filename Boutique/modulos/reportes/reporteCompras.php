


<?php

require_once "../../configuracionSesionUsuario.php";



require_once "../../class/Sexo.php";
require_once "../../class/Empleado.php";
require_once "../../class/Cliente.php";
require_once "../../class/Proveedor.php";

require_once "../../class/Categoria.php";
require_once "../../class/Empleado.php";
$listadoEmpleados= Empleado::obtenerTodosActivos();
$listadoProveedor= Proveedor::obtenerTodosActivos();
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

if (!isset($_GET['Proveedor'])) {
    $Proveedor = 0;
} else {
    $Proveedor = $_GET['Proveedor'];
}


require_once "../../class/Venta.php";
require_once "../../class/DetalleVenta.php";
require_once "../../class/Compra.php";
require_once "../../class/DetalleCompra.php";
$año= strftime("%Y");;
$lista = Compra::obtenerTodosComprasProveedor($Empleado,$Proveedor, $fechaDesde,$fechaHasta );
$comprasDelAño = Compra::obtenerComprasPorMeses($año);
$comprasDelMes = Compra::obtenerComprasPorMesActual();
$comprasDeLaSemana = Compra::obtenerComprasPorSemanaActual();
$comprasDelDia = Compra::obtenerComprasPorDiaActual();

$dataPoints = [];
foreach($comprasDelAño as $compra){

    $dataPoints[]= array("label"=>$compra->getMes(), "y"=>$compra->getTotal());
}
$dataPoints2 = [];
$semana=0;
foreach($comprasDelMes as $compraMes){
    if($semana < $compraMes->getSemana()){
        $semana = $compraMes->getSemana();
    }
    }
foreach($comprasDelMes as $compraMes){

    $diaInicio =date("d", strtotime($compraMes->getFechaInicio()));
    $diaFin =date("d", strtotime($compraMes->getFechaFin()));
    $ultimoDia =date("d", strtotime($compraMes->getUltimoDia()));


    if($semana == $compraMes->getSemana()){
        $diaFin = date("d", strtotime($compraMes->getUltimoDia()));
        
    }if ($compraMes->getSemana() == 1) {
        $diaInicio= 1;
    }
    $dataPoints2[]= array("label"=>"Dias ".$diaInicio." al ".$diaFin, "y"=>$compraMes->getTotal());
}
$dataPoints3 = [];

foreach($comprasDeLaSemana as $compraSemana){
    if($compraSemana->getDia() == 1){
        $dia = "Domingo";
    }elseif($compraSemana->getDia() ==2){
        $dia = "Lunes";
    }elseif($compraSemana->getDia()== 3){
        $dia = "Martes";
    }elseif($compraSemana->getDia()== 4){
        $dia = "Miercoles";
    }elseif($compraSemana->getDia() ==5){
        $dia = "Jueves";
    }elseif($compraSemana->getDia()== 6){
        $dia = "Viernes";
    }elseif($compraSemana->getDia()== 7){
        $dia = "Sabado";
    };

    $dataPoints3[]= array("label"=>$dia, "y"=>$compraSemana->getTotal());
}

$dataPoints4 = [];
foreach($comprasDelDia as $compraDelDia){
   

    $dataPoints4[]= array("label"=>$compraDelDia->empleado->getNombre()."".$compraDelDia->empleado->getApellido(), "y"=>$compraDelDia->getTotal());
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
        <title>Reporte de Compras</title>
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
                    <span id="modulo">Compras</span>
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
         
                <h4 id="tituloAnual">Grafico de Compras Anual</h4>
                <div id="chartContainer"></div>
                <h4 id="tituloMensual" style="display: none">Grafico de Compras Mensual</h4>
                <div id="chartContainer2"></div>
                <h4 id="tituloSemanal" style="display: none">Grafico de Compras Semanal</h4>
                <div id="chartContainer3"></div> 
                <h4 id="tituloDia" style="display: none">Grafico de Compras del Dia</h4>
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
                     <?php foreach($comprasDelAño as $comprasDelAño){ ?>
                     <tr class="active-row">
                        <td><?php echo $comprasDelAño->getMes(); ?></td>
                        <td><?php echo $comprasDelAño->getCantidad(); ?></td>
                        <td>$<?php echo $comprasDelAño->getTotal(); ?></td>
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
                     <?php foreach($comprasDelMes as $comprasDelMes){ ?>
                     <tr class="active-row">
                        <td><?php echo $comprasDelMes->getSemana(); ?></td>
                        <td><?php echo $comprasDelMes->getFechaInicio(); ?></td>
                        <td><?php echo $comprasDelMes->getFechaFin(); ?></td>
                        <td><?php echo $comprasDelMes->getCantidad(); ?></td>
                        <td>$<?php echo $comprasDelMes->getTotal(); ?></td>
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
                   <?php foreach($comprasDeLaSemana as $comprasDeLaSemana){ ?>
                       <tr class="active-row">
                        <?php  if($comprasDeLaSemana->getDia() == 1){
                            $dia = "Domingo";
                        }elseif($comprasDeLaSemana->getDia() ==2){
                            $dia = "Lunes";
                        }elseif($comprasDeLaSemana->getDia()== 3){
                            $dia = "Martes";
                        }elseif($comprasDeLaSemana->getDia()== 4){
                            $dia = "Miercoles";
                        }elseif($comprasDeLaSemana->getDia() ==5){
                            $dia = "Jueves";
                        }elseif($comprasDeLaSemana->getDia()== 6){
                            $dia = "Viernes";
                        }elseif($comprasDeLaSemana->getDia()== 7){
                            $dia = "Sabado";
                        }; ?>
                        <td><?php echo $dia; ?></td>
                        <td><?php echo $comprasDeLaSemana->getCantidad(); ?></td>
                        <td>$<?php echo $comprasDeLaSemana->getTotal(); ?></td>
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
                     <?php foreach($comprasDelDia as $comprasDelDia){ ?>
                     <tr class="active-row">
                        <td><?php echo $comprasDelDia->empleado->getNombre(); ?></td>
                        <td><?php echo $comprasDelDia->getCantidad(); ?></td>
                        <td>$<?php echo $comprasDelDia->getTotal(); ?></td>
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
                <label>Proveedor: </label>    
                   <select name="Proveedor" id="Proveedor" >
                    <option value="NULL">---Seleccionar---</option>

                    <?php foreach ($listadoProveedor as $proveedor): ?>


                        <option value="<?php echo $proveedor->getIdProveedor(); ?>">
                            <?php echo $proveedor->getNombreProveedor(); echo " ";
                            echo $proveedor->getCUIT();?>
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
                        <th>Proveedor</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Venta</th>
                        <th>Total</th>


                    </tr>

                </thead>
                <tbody>
                    <?php foreach($lista as $compra){ ?>
                        <tr class="active-row">
                            <td><?php echo $compra->getIdCompra(); ?></td>
                            <td><?php echo $compra->getFechaHora() ?></td>
                            <td><?php
                            $idEmpleado = $compra->getIdEmpleado();
                            if (empty($idEmpleado)){

                                echo "Pagina Web";
                            } else {
                                $empleado= Empleado::obtenerPorId($idEmpleado);
                                echo $empleado->getNombre();
                                echo "<br>";
                                echo $empleado->getApellido();

                            }

                        ?></td>
                        <td><?php echo $compra->proveedor->getNombreProveedor();?></td>
                        <?php
                        $id_compra=  $compra->getIdCompra();
                        $listaDetalles = DetalleCompra::obtenerPorIdCompra($id_compra);


                        ?>
                        <td>

                          <?php  foreach($listaDetalles as $detalleCompra){ 
                            echo $detalleCompra->productoTalle->producto->getNombreProducto(); 
                            echo "<br>";
                        }
                        ?>


                    </td>
                    <td>
                     <?php  foreach($listaDetalles as $detalleCompra){ 
                        echo $detalleCompra->getCantidad(); 
                        echo "<br>";
                    }
                    ?>
                </td>
                <td>
                 <?php  foreach($listaDetalles as $detalleCompra){ 

                    echo "$".$detalleCompra->getPrecio(); 
                    echo "<br>";
                }
                ?>
            </td>



            



            <td><?php echo "$".$compra->getTotal() ?></td>

        </tr>
    <?php } ?>
</tbody>

<tfoot>
  
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><b>CANTIDAD DE COMPRAS</b></td>
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
        foreach($lista as $totalCompra){
            $totalAcumular= $totalCompra->getTotal();
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

