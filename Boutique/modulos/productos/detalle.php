



<?php

require_once "../../configuracionSesionUsuario.php";



require_once "../../class/Sexo.php";
require_once "../../class/Producto.php";
require_once "../../class/Categoria.php";
require_once "../../class/Temporada.php";


$listadoTemporada = Temporada::obtenerTodos();

$listadoCategoria = Categoria::obtenerTodos();




$listadoSexo = Sexo::obtenerTodos();


$idProducto = $_GET["id_producto"];


$Producto = Producto::obtenerPorId($idProducto);


?>
<?php


$mensaje = "";
$mensaje1 = "";
$mensaje2 = "";

if (isset($_GET["error"])) {
    // code...
    switch ($_GET["error"]) {

    case 'nombreProductoAñadir':
        $mensaje = "<div class='error'>"."El nombre del Producto solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio."."</div>";
        break;

     case 'marcaAñadir':
        $mensaje = "<div class='error'>"."La marca del Producto solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio."."</div>";
        break;   
     case 'descripcionAñadir':
        $mensaje = "<div class='error'>"."La descripcion del Producto solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio."."</div>";
        break;   

    case 'precioCompraAñadir':
        $mensaje = "<div class='error'>"."El Precio de compra tiene que ser de 1 a 5 dígitos y solo puede contener numeros"."</div>";
        break;

    case 'precioVentaAñadir':
        $mensaje = "<div class='error'>"."El Precio de venta tiene que ser de 1 a 5 dígitos y solo puede contener numeros"."</div>";
        break;

    case 'nombreProductoModificar':
        $mensaje1 = "<div class='error'>"."El nombre del Producto solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio."."</div>";
        break;

     case 'marcaModificar':
        $mensaje1 = "<div class='error'>"."La marca del Producto solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio."."</div>";
        break;   
     case 'descripcionModificar':
        $mensaje1 = "<div class='error'>"."La descripcion del Producto solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio."."</div>";
        break;   

    case 'precioCompraModificar':
        $mensaje1 = "<div class='error'>"."El Precio de compra tiene que ser de 1 a 5 dígitos y solo puede contener numeros"."</div>";
        break;

    case 'precioVentaModificar':
        $mensaje1 = "<div class='error'>"."El Precio de venta tiene que ser de 1 a 5 dígitos y solo puede contener numeros"."</div>";
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
        <title>Productos</title>
        <meta charset="UTF-8">
        <meta name="author" content="Nicolas Gauna">
        <meta name="description" content="Sistema de Control de Stock y ventas Online">
        <link rel="shortcut icon" href="/programacion_3/boutique/img/logo.ico">
        <script src="/programacion_3/boutique/jquery/jquery-3.3.1.min.js"></script>
        
        <!-- Validaciones JS -->
        <script src="../../js/formularioProductoNuevo.js"></script>
        <script src="../../js/formularioProductoModificar.js"></script>
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
         <script src="../../js/tablaDatatable.js"></script>
        <script src="../../js/cargarImagenPerfil.js" >

        </script>

    </head>
    <body>
        <!--========== HEADER ==========-->
        <header class="header">
            <div class="header__container">
                <button class="btnVolver"type="button" onClick="history.go(-1);"><i class="botonGeneral fas fa-reply"></i></button>

                <div class="nombreModulo">
                    <span id="abmModulo">Detalle</span>
                    <span id="modulo">producto</span>
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


                <div id="containerNuevo">
                    <button class="botonAñadir" id="abrir" onclick="abrirModal(this.id);" ><i class="fas fa-plus"></i> Añadir </button>
                   
                </div>
                <br>
                


                <div id="container">
                    <table id="tabla10" class="styled-table" >
                        <thead>
                            <tr>
                                <th>ID </th>
                                <th>IMAGEN</th>
                                <th>NOMBRE</th> 
                                <th>DESCRIPCION</th> 
                                <th>MARCA</th> 
                                <th>PRECIO VENTA</th>
                                <th>PRECIO COMPRA</th>
                                <th>CATEGORIA</th>
                                <th>TEMPORADA</th>
                                <th>FECHA ALTA</th>      
                            </tr>
                        </thead>

                        <tbody>
                                <tr class="active-row">

                                    <td><?php echo $Producto->getIdProducto(); ?></td>
                                    <td><img src='<?php echo $Producto->getImagen(); ?>'style="max-width:100px;width:70px;height:100px;"></td>
                                    <td><?php echo $Producto->getNombreProducto(); ?></td>
                                    <td><?php echo $Producto->getDescripcion(); ?></td>
                                    <td><?php echo $Producto->getMarca(); ?></td>
                                    <td>$<?php echo $Producto->getPrecioVenta(); ?></td>
                                    <td>$<?php echo $Producto->getPrecioCompra(); ?></td>
                                    <td><?php echo $Producto->categoria->getNombre(); ?></td>
                                    <td><?php echo $Producto->temporada->getNombre(); ?></td>
                                    <td><?php echo $Producto->getFecha(); ?></td>
                                   

                                </tr>

                        </tbody>

                    </table>
                </div>

                <!-- Ventana modal Añadir -->

                <div id="miModal" class="modal">
                    <div class="flex" id="flex">
                        <div class="contenido-modal">
                            <div class="modal-header flex">
                                <h2>Añadir Nuevo Producto</h2>
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
                                <h2>Modificar Producto</h2>
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
                                <h2>Eliminar Producto</h2>
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

