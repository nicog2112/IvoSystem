


<?php

require_once "../../configuracionSesionUsuario.php";



require_once "../../class/Sexo.php";



$listadoSexo = Sexo::obtenerTodos();



if (isset($_GET["cboFiltroEstado"])) {
    $filtroEstado = $_GET["cboFiltroEstado"];
} else {
    $filtroEstado = 1; // ACTIVOS
}


require_once "../../class/Talle.php";
require_once "../../class/Cliente.php";
require_once "../../class/Empleado.php";
require_once "agregarAlCarrito.php";
require_once "../../class/ProductoTalle.php";
require_once "../../class/TipoFactura.php";
require_once "../../class/EstadosPago.php";
require_once "../../class/TipoPago.php";
require_once "../../class/TiposImpositivos.php";
require_once "../../class/Producto.php";
require_once "../../class/Factura.php";

$listadoTiposImpositivos = TiposImpositivos::obtenerPorEstado();

$listadoTalle = Talle::obtenerTodosActivos();
$listadoClientes = Cliente::obtenerTodosActivos();
$listadoEmpleados = Empleado::obtenerTodosActivos();
$listadoTipoFactura = TipoFactura::obtenerTodosActivos();
$listadoEstadosPagos = EstadosPagos::obtenerTodos();
$listadoTipoPago = TipoPago::obtenerTodosActivos();
$listadoProductos = Producto::obtenerTodosActivos();





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
        <title>Ventas</title>
        <meta charset="UTF-8">
        <meta name="author" content="Nicolas Gauna">
        <meta name="description" content="Sistema de Control de Stock y ventas Online">
        <link rel="shortcut icon" href="/programacion_3/boutique/img/logo.ico">
        <script src="/programacion_3/boutique/jquery/jquery-3.3.1.min.js"></script>
        
        <!-- select2 -->
        <link href="../../css/select2.css" rel="stylesheet"/>

<script src="/programacion_3/boutique/js/select2.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($){
    $(document).ready(function() {
        $('#idProducto').select2();
        $('#cliente').select2();
        $("#idProducto").select2({
    containerCssClass: "formulario__input" 
});
    });
});
</script>
        <!-- Validaciones JS -->
        <script src="../../js/formularioAgregarCarrito.js"></script>
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
        <script src="../../js/cargarImagenPerfil.js" >

        </script>
        <script src="../../js/selectAnidados.js"></script>
                       <style>
    .error{
        background-color: #FF9185;
        font-size: 12px;
        padding: 10px;
        text-align: center;
    }
    .correcto{
        background-color: #A0DEA7;
        font-size: 12px;
        padding: 10px;
        text-align: center;
    }
    #cajon1{
        float:left;
        border-spacing: 5px;
        border-collapse: collapse;
        border-radius: 15px;
        overflow: hidden;
        text-align: center; 
        margin: 0px 30px   ;
        font-size: 0.7em;
        font-family: sans-serif;
        width: 95%;
        height: 300px;
        min-width: 200px;
        box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.15);
        margin-bottom: 10px;
        
    }
    #cajon1 h1{
        background-color: #400098; 
        color: #ffffff;
        text-align: center;
        padding: 12px 15px;
     margin-top: 0px;}

        
        </style>
    </head>
    <body onload="selectAnidadosProducto();validarFormularioCarrito();">
        <!--========== HEADER ==========-->
        <header class="header">
            <div class="header__container">
                <button class="btnVolver"type="button" onClick="history.go(-1);"><i class="botonGeneral fas fa-reply"></i></button>

                <div class="nombreModulo">
                    <span id="abmModulo">Realizar</span>
                    <span id="modulo">venta</span>
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
    <section>


       <?php 
        if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
        $granTotal = 0;

        ?>
        <section class="home-section">

            
            
            <?php
            if(isset($_GET["status"])){
                if($_GET["status"] === "1"){
                    ?>
                    <div class="correcto">
                        <strong>¡Correcto!</strong> Venta realizada correctamente
                    </div>

                    <?php
                }else if($_GET["status"] === "2"){
                    ?>
                    <div class="correcto">
                        <strong>Venta cancelada</strong>
                    </div>
                    <?php
                }else if($_GET["status"] === "3"){
                    ?>
                    <div class="correcto">
                        <strong>Ok</strong> Producto quitado de la lista
                    </div>
                    <?php
                }else if($_GET["status"] === "4"){
                    ?>
                    <div class="error">
                        <strong>Error:</strong> El producto que buscas no existe
                    </div>
                    <?php
                }else if($_GET["status"] === "5"){
                    ?>
                    <div class="error">
                        <strong>Error: </strong>El producto está agotado
                    </div>
                    <?php
                }else if($_GET["status"] === "6"){
                    ?>
                    <div class="error">
                        <strong>Error: </strong>La cantidad no puede estar vacia y debe ser mayor a 0
                    </div>
                    <?php
                }else if($_GET["status"] === "7"){
                    ?>
                    <div class="error">
                        <strong>Error: </strong>Debe seleccionar un producto y un talle
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="error">
                        <strong>Error:</strong> Algo salió mal mientras se realizaba la venta
                    </div>
                    <?php
                }
            }
            ?>
             
                <div class="formulario__mensaje" id="formulario__mensaje">
                <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
            </div>
            
            <div class="formulario__grupo formulario__grupo-btn-enviar">
                
                <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Verificando Stock del Producto!</p>
            
            </div>
            <br>
            <div id="cajon1" >
                <h1>Añadir Producto al carrito</h1>

                <form method="post" action="agregarAlCarrito.php" name="formularioNuevo" id="formularioNuevo" >
                    
                    <input type="hidden" name="promocion" value="0">
                    <input type="hidden" name="estado" value="1">

                    <div class="formulario__grupo" id="grupo__idProducto" style="width:45%">
                        <label for="idProducto" class="formulario__label">Código del producto:</label>
                        <div class="formulario__grupo-input">
                            <select name="idProducto" id="idProducto" class="formulario__input" required>
                                <option value="NULL">---Seleccionar---</option>

                                <?php foreach ($listadoProductos as $productoSelect): ?>


                                <option value="<?php echo $productoSelect->getIdProducto(); ?>">
                                    <?php echo $productoSelect->getIdProducto(); 
                                        echo " ";
                                    echo $productoSelect->getNombreProducto(); ?>
                                </option>
                                <?php endforeach ?>

                            </select>
                            
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>
                        
                        <br>
                        <p class="formulario__input-error">Error</p>
                    </div>

                    <label for="cantidadDisponible" class="formulario__label" style="float: right; margin-top: -55px; margin-right: 200px;">Cantidad disponible:</label>
                    <div  class="formulario__input"  style="width:45%; height: 30px; float:right;  margin-top: -40px; text-align:center; font-size: 20px;   font-weight: bold; vertical-align: top;" >
                    <p name="cantidadDisponible" id="cantidadDisponible" style=" margin-top: -10px;" >0</p>  
                    </div>



                    <div class="formulario__grupo" id="grupo__cboTalle" style="width:45%">
                        <label for="cboTalle" class="formulario__label">Talle:</label>
                        <div class="formulario__grupo-input">
                            <select required class="formulario__input" name="cboTalle" id="cboTalle" >
                                <option value="NULL" >---Seleccionar---</option>

                               

                                
                                
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </select>
                        </div>  
                        <br>
                        <p class="formulario__input-error">Error</p>
                    </div>

                    <label for="cantidadDisponibleTalle" class="formulario__label" style="float: right; margin-top: -55px; margin-right: 200px;">Cantidad disponible:</label>
                    <div  class="formulario__input"  style="width:45%; height: 30px; float:right;  margin-top: -40px; text-align:center; font-size: 20px;   font-weight: bold; vertical-align: top;" >
                    <p name="cantidadDisponibleTalle" id="cantidadDisponibleTalle" style=" margin-top: -10px;" >0</p>  
                    </div>

                     <div class="formulario__grupo" id="grupo__cantidad" style="width:45%; text-align:center; margin:auto;" >
                        <label for="cantidad" class="formulario__label">Cantidad:</label>
                        <div class="formulario__grupo-input">
                            <input required  type="number" class="formulario__input" name="cantidad" id="cantidad" placeholder="Escribe la cantidad">
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>  
                        <p class="formulario__input-error">Error: La cantidad no puede estar vacia y debe ser mayor a 0</p>
                    </div>
                     
                    <br>
                  <button class="botonAñadir" type="submit" ><i class="fas fa-cart-plus"></i> Agregar al carrito </button>
                    
                </div>
            </form>
        </div>
        
        <br>
        
        
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Imagen</th>
                    <th>Descripción</th>
                    <th>Talle</th>
                    <th>Precio de venta</th>
                    <th>Descuento x Promocion</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Quitar</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($_SESSION["carrito"] as $indice => $producto){ 
                    $granTotal += $producto->subtotal;
                    ?>
                    <tr class="active-row">
                        <td><?php echo $producto->getIdProductoTalle() ?></td>
                        <td><?php echo $producto->getIdProducto() ?></td>
                        <td><img src='../../modulos/productos/<?php echo $producto->producto->getImagen() ?>'style="max-width:100px;width:70px;height:100px;"></td>
                        <td><?php echo $producto->producto->getDescripcion() ?></td>
                        <td>
                            <?php 
                            $id_talle=$producto->getIdTalle();
                            foreach ($listadoTalle as $talle): 

                                if ($talle->getIdTalle() == $id_talle) {
                                    echo $talle->getDescripcion();;
                                }
                            endforeach
                            ?>
                            
                        </td>
                        <td>$<?php echo $producto->producto->getPrecioVenta() ?></td>
                        <td><?php echo 0 ?></td>
                        <td><?php echo $producto->cantidad ?></td>
                        <td>$<?php echo $producto->subtotal ?></td>
                        <td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>"><i class="botonEliminar fas fa-trash"></i></a></td>
                    </tr>
                <?php } ?>
                    <tr>
                        <td><td colspan="7"><h3 style="text-align: right;" >SubTotal: </h3></td></td>
                        <td>$<?php echo $granTotal; ?></td>
                    </tr>
                    <?php $totalSumaImpuestos = 0; //obtener valor impuestos

                        foreach ($listadoTiposImpositivos as $tiposImpositivos):
                        $nombreImpuesto= $tiposImpositivos->getDescripcion();
                        $valorPorcentajeImpuesto= $tiposImpositivos->getValorPorcentaje();
                        $totalImpuesto= $granTotal * $valorPorcentajeImpuesto / 100;
                        $totalSumaImpuestos= $totalSumaImpuestos + $totalImpuesto; ?>
                            
      
                    
                    <tr>
                        <td><td colspan="7"><h3 style="text-align: right;" ><?php echo $nombreImpuesto; echo " ";echo $valorPorcentajeImpuesto;  ?>% </h3></td></td>
                        <td>$<?php echo $totalImpuesto; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="8"><h3 style="text-align: right;" >Total </h3></td></td>
                        <td>$<?php $totalFinal= $totalSumaImpuestos + $granTotal;
                         echo $totalFinal; ?></td>
                    </tr>
            </tbody>
            
        </table>
    </div>
    <br><br>
    <div id="containerNuevo">
    <a href="./cancelarVenta.php" class="botonCancelar" style="width:150px;">Cancelar venta</a>
     <?php
    if (empty($_SESSION["carrito"])){
        
    } else {
  
  ?>
      
    
    <a href="#" id="abrir" class="botonAñadir" onclick="abrirModal(this.id);" >Realizar Venta</a>
       
  <?php      }
    ?>
</div>


    <br><br>
    <div id="miModal" class="modal">
        <div class="flex" id="flex">
            <div class="contenido-modal">
                <div class="modal-header flex">
                    <h2>Realizar Venta</h2>
                    <span class="close" id="close">&times;</span>
                </div>
                <div class="modal-body">
                    <form action="./terminarVenta.php" method="POST" id="formulario">
                        
                        <input name="total" type="hidden" value="<?php echo $granTotal;?>">
                        <input name="estado" type="hidden" value="1">
                        





                        <!-- Grupo: Cliente -->
                        <div class="formulario__grupo" id="grupo__cliente">
                            <label for="cliente" class="formulario__label">Cliente</label>
                            <div class="formulario__grupo-input">
                                <select name="cliente" id="cliente" class="formulario__input" required style="width:100%;">
                                    <option value="">---Seleccionar---</option>

                                    <?php foreach ($listadoClientes as $cliente): ?>

                                        
                                        <option value="<?php echo $cliente->getIdCliente(); ?>">
                                            <?php echo $cliente->getNombre(); echo " ";
                                            echo $cliente->getApellido(); echo " ";
                                            echo $cliente->getDNI();?>
                                        </option>
                                    <?php endforeach ?>

                                </select>
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <br>
                            <p class="formulario__input-error">El cliente no puede estar vacio. Seleccione una opcion</p>
                        </div>







                        
                        
                        <?php $idPersona = $usuario->getIdPersona(); 
                        $empleado = Empleado::obtenerPorIdPersona($idPersona);?>
                        
                        <input type="text" class="formulario__input" hidden="hidden" name="Empleado" id="Empleado" value="<?php echo $empleado->getIdEmpleado(); ?>" >



                        <!-- Grupo: TipoFactura -->
                        <div class="formulario__grupo" id="grupo__TipoFactura" >
                            <label for="tipoFactura" class="formulario__label">Tipo de Factura</label>
                            <div class="formulario__grupo-input">
                                <select name="tipoFactura" id="tipoFactura" class="formulario__input" required>
                                    <option value="">---Seleccionar---</option>

                                    <?php foreach ($listadoTipoFactura as $tipoFactura): ?>

                                        
                                        <option value="<?php echo $tipoFactura->getIdTipoFactura(); ?>">
                                            <?php echo $tipoFactura->getDescripcion();?>
                                        </option>
                                    <?php endforeach ?>

                                </select>
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <br>
                            <p class="formulario__input-error">El TIPO FACTURA no puede estar vacio. Seleccione una opcion</p>
                        </div>


                        <!-- Grupo: EstadosPagos -->
                        <div class="formulario__grupo" id="grupo__estadosPagos" hidden="hidden">
                            <label for="estadosPagos" class="formulario__label">Estado del Pago</label>
                            <div class="formulario__grupo-input">
                                <select name="estadosPagos" id="estadosPagos" class="formulario__input" >
                                    

                                    <?php foreach ($listadoEstadosPagos as $estadosPagos): ?>

                                        
                                        <option value="<?php echo $estadosPagos->getIdEstadosPagos(); ?>">
                                            <?php echo $estadosPagos->getDescripcion();?>
                                        </option>
                                    <?php endforeach ?>

                                </select>
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <br>
                            <p class="formulario__input-error">El TIPO FACTURA no puede estar vacio. Seleccione una opcion</p>
                        </div>


                        <!-- Grupo: TipoPago -->
                        <div class="formulario__grupo" id="grupo__TipoPago">
                            <label for="tipoPago" class="formulario__label">Tipo de Pago</label>
                            <div class="formulario__grupo-input">
                                <select name="tipoPago" id="tipoPago" class="formulario__input" required>
                                    <option value="">---Seleccionar---</option>

                                    <?php foreach ($listadoTipoPago as $tipoPago): ?>

                                        
                                        <option value="<?php echo $tipoPago->getIdTipoPago(); ?>">
                                            <?php echo $tipoPago->getDescripcion();?>
                                        </option>
                                    <?php endforeach ?>

                                </select>
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <br>
                            <p class="formulario__input-error">El TIPO PAGO no puede estar vacio. Seleccione una opcion</p>
                        </div>

                       
                        <?php 
                        $facturaNumeracion= Factura::obtenerUltimaNumeracion();
                         ?>
                        <input type="hidden" class="formulario__input" name="numeracion" id="numeracion" value="<?php echo $facturaNumeracion->getNumeracion(); ?>"  >




                        <input type="hidden" name="promocion" value="1">
                        <br><br>
                        <button type="submit" class="botonGuardar">Terminar venta</button>
                        <a href="./cancelarVenta.php" class="botonCancelar">Cancelar venta</a>
                        
                        <br><br>
                    </form>
                    
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

                <?php $perfilUsuario = $usuario->getIdPerfil();
                if($perfilUsuario == 1){ ?>

                <!--========== Menu Configuracion ==========-->
                <div class="container">
                    <div class="menu-toggle">
                        <span class="fa fa-cog" onclick="menuConfiguracion(event)"></span>
                    </div>
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
                <?php } ?>
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
