
<?php

require_once "../../configuracionSesionUsuario.php";



require_once "../../class/Sexo.php";



$listadoSexo = Sexo::obtenerTodos();



require_once "../../class/Temporada.php";
require_once "../../class/Categoria.php";

$listadoCategoria = Categoria::obtenerTodos();

$listadoTemporada = Temporada::obtenerTodos();



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
        <title>Categorias</title>
        <meta charset="UTF-8">
        <meta name="author" content="Nicolas Gauna">
        <meta name="description" content="Sistema de Control de Stock y ventas Online">
        <link rel="shortcut icon" href="/programacion_3/boutique/img/logo.ico">
        <script src="/programacion_3/boutique/jquery/jquery-3.3.1.min.js"></script>
        
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
        <script src="../../js/cargarImagenPerfil.js" >

        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#cboMetodo').change(function(e) {
                if ($(this).val() === "1" ) {
                    $('#categoria').prop("hidden", false);
                } else {
                    $('#categoria').prop("hidden", true);
                }
                if ($(this).val() === "2" ) {
                    $('#temporada').prop("hidden", false);
                } else {
                    $('#temporada').prop("hidden", true);
                }
                if ($(this).val() === "3" ) {
                    $('#marca').prop("hidden", false);
                } else {
                    $('#marca').prop("hidden", true);
                }

            })
            $('#cboMetodoActualizar').change(function(e) {
                if ($(this).val() === "1" ) {
                    $('#porcentaje').prop("hidden", false);
                } else {
                    $('#porcentaje').prop("hidden", true);
                }
                if ($(this).val() === "2" ) {
                    $('#valorFijo').prop("hidden", false);
                } else {
                    $('#valorFijo').prop("hidden", true);
                }
            

            })
        });


    </script>

    </head>
    <body>
        <!--========== HEADER ==========-->
        <header class="header">
            <div class="header__container">
                <button class="btnVolver"type="button" onClick="history.go(-1);"><i class="botonGeneral fas fa-reply"></i></button>

                <div class="nombreModulo">
                    <span id="abmModulo">Listado</span>
                    <span id="modulo">categorias</span>
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


               <center>
        <div class="form__top">
            <h2>Formulario Actualizacion de <span>Precios de Venta</span></h2>
        </div>  


              
            <form method="POST" action="procesarActualizarPrecioPorcentaje.php" enctype="multipart/form-data" class="form__reg">
                <div>

                    <div class="formulario__grupo" id="grupo__" >
                        <label for="cboMetodo" class="formulario__label">Seleccione que Metodo desea usar para actualizar los precios:</label>
                        <div class="formulario__grupo-input">
                            <select name="cboMetodo" id='cboMetodo' class="formulario__input" >
                                <option value="NULL">---Seleccionar---</option>

                                <option value="1">Actualizar por Categorias</option>
                                <option value="2">Actualizar por Temporada</option>
                                <option value="3">Actualizar por Marca </option>

                            </select>

                        </div>
                        <br>
                        <p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

                    </div>
                </div>



                <div id="categoria" hidden="hidden">

                    <div class="formulario__grupo" id="grupo__" >
                        <label for="cboMetodo" class="formulario__label">Seleccione la categoria:</label>
                        <div class="formulario__grupo-input">
                            <select name="categoria"  class="formulario__input">
                                <option value="NULL">---Seleccionar---</option>

                                <?php foreach ($listadoCategoria as $categoria): ?>

                                    <option value="<?php echo $categoria->getIdCategoria(); ?>">
                                        <?php echo $categoria->getNombre(); ?>
                                    </option>

                                <?php endforeach ?>
                            </select>
                        </div>
                        <br>
                        <p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

                    </div>
                </div>



                <div id="temporada" hidden="hidden">

                    <div class="formulario__grupo" id="grupo__" >
                        <label for="cboMetodo" class="formulario__label">Seleccione la temporada:</label>
                        <div class="formulario__grupo-input">
                            <select name="temporada"  class="formulario__input">
                                <option value="NULL">---Seleccionar---</option>

                                <?php foreach ($listadoTemporada as $temporada): ?>

                                    <option value="<?php echo $temporada->getIdTemporada(); ?>">
                                        <?php echo $temporada->getNombre(); ?>
                                    </option>

                                <?php endforeach ?>
                            </select>

                        </div>
                        <br>
                        <p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

                    </div>
                </div>


                <div id="marca" hidden="hidden">
                    <div class="formulario__grupo" id="grupo__cuit" >
                        <label for="cuit" class="formulario__label">Escriba la Marca:</label>
                        <div class="formulario__grupo-input">
                            <input name="marca"  type="text"  class="formulario__input" placeholder="Marca">
                        </div>
                        <br>
                        <p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

                    </div>
                </div>




                <div>

                    <div class="formulario__grupo" id="grupo__" >
                        <label for="cboMetodoActualizar" class="formulario__label">Seleccione como desea actualizar los precios:</label>
                        <div class="formulario__grupo-input">
                            <select name="cboMetodoActualizar" id='cboMetodoActualizar' class="formulario__input" >
                                <option value="NULL">---Seleccionar---</option>

                                <option value="1">Actualizar por Porcentace</option>
                                <option value="2">Actualizar por Valor Fijo</option>


                            </select>

                        </div>
                        <br>
                        <p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

                    </div>
                </div>




                <div id="porcentaje" hidden="hidden">
                    <div class="formulario__grupo" id="grupo__cuit" >
                        <label for="cuit" class="formulario__label">Escriba el porcentaje:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" name="porcentaje" class="formulario__input">
                        </div>
                        <br>
                        <p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

                    </div>
                </div>

                <div id="valorFijo" hidden="hidden">
                    <div class="formulario__grupo" id="grupo__cuit" >
                        <label for="cuit" class="formulario__label">Escriba el valor Fijo:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" name="valorFijo" class="formulario__input">
                        </div>
          
                        <p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

                    </div>
                </div>


                <div id="accion">
                    <div class="formulario__grupo" id="grupo__cuit" >
                        <label for="cuit" class="formulario__label">Accion a realizar</label>
                        <div class="formulario__grupo-input">
                            <input type = "radio" name = "accion" value = "1" /> Aumentar
                            <input type = "radio" name = "accion" value = "2" /> Disminuir
                        </div>
                   
                        <p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

                    </div>
                </div>



                <input type="submit" name="Guardar" class="btn__submit" >
                <br>
                <br>


            </form>
        </center>

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



     
 