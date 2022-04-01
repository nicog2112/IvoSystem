<?php

require_once "configs.php";

require_once "../../../class/Usuario.php";
require_once "../../../class/ProductoTalle.php";

require_once "../../../class/Modulo.php";

$lista = Modulo::obtenerTodos();



session_start();

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
} else {
    header("location: /programacion_3/boutique/form_login.php?error=" . MENSAJE_CODE);
    exit;
}

$listadoModulos = $usuario->perfil->getModulos();


?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="/programacion_3/boutique/jquery/jquery-3.3.1.min.js"></script>

        <link rel="stylesheet" href="/programacion_3/boutique/css/tablaNUEVO.css">
        <link rel="stylesheet" href="/programacion_3/boutique/css/botonesNUEVO.css">
        <link rel="stylesheet" href="/programacion_3/boutique/css/modalNUEVO.css">	
        
        <!--========== FONTAWESOME ICONS ==========-->
        <link rel="stylesheet" href="/programacion_3/boutique/css/all.min.css">

        <!--========== CSS ==========-->
        <link rel="stylesheet" href="/programacion_3/boutique/css/MenuHeaderFooter.css">
        <link rel="stylesheet" href="/programacion_3/boutique/css/MenuConfiguracion.css">
        <link rel="shortcut icon" href="/programacion_3/boutique/img/logo.ico">
        <script src="/programacion_3/boutique/js/ventanaModal.js" ></script>
         <!--========== menuPerfil flecha arriba y abajo y desplegue de menu perfil ==========-->
        <script type="text/javascript">
            function showMenu(e){
              e.preventDefault();
              $("#menu").slideToggle();
              $(".rotate").toggleClass("down"); 
          }

          function hideMenu(){
              $("#menu").slideUp();
          }


      </script>
      <!--========== Menu Configuracion ==========-->
      <script type="text/javascript">
          function menuConfiguracion(e){
            e.preventDefault();
            $(".menu-toggle").toggleClass("open");
            $(".menu-round").toggleClass("open");
            $(".menu-line").toggleClass("open");
};

</script>



  <title>IVO SYSTEM</title>
</head>
    <body>
        <!--========== HEADER ==========-->
        <header class="header">
            <div class="header__container">
            <span id="nombreDeUsuario"><?php echo $usuario->getNombre(); echo " "; echo $usuario->getApellido(); ?></span>
             <span id="nombreDePerfil"><?php echo $usuario->perfil->getDescripcion(); ?></span>

                
            <img id="perfil" onclick="showMenu(event)" onblur="hideMenu()" src="/programacion_3/boutique/img/perfil.jpg" alt="" class="header__img">
            <i id="flechaPerfil" class='fa fa-chevron-up rotate'></i>
            <div id="menu" class="menuPerfil">
                            <a href="/programacion_3/boutique/perfilDetalle.php"><i class='fas fa-user-circle nav__icon' ></i><span id="perfilDetalle">Mi Perfil</span></a>
                            <a href="/programacion_3/boutique/cerrar_sesion.php"><i class='fa fa-sign-out-alt nav__icon' ></i><span id="CerrarSesion">Cerrar Sesion</span></a>
                  
            </div>

  
                
                <div class="header__logoIVO">
                    <img id="logo" src="/programacion_3/boutique/logo2.png">
                    <a href="#" class="header__logoPalabra">IVO SYSTEM</a>
                   
                </div>
                
            </div>
        </header>

        <!--========== NAV ==========-->
        <div class="nav" id="navbar">
            <nav class="nav__container">
                <div>
                    <a href="#" class="nav__link nav__logo">
                        <i class='fas fa-bars nav__icon' ></i>
                        <span class="nav__logo-name">Menu</span>
                    </a>
                    
                    <div class="nav__list">
                        <div class="nav__items">

                            <a href="#" class="nav__link active">
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
                                            if ($modulo->getIdModulo() == $modulo2->getHijoDe()) {
                                               ?>
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


        <div id="containerNuevo">
            <button value="" class="botonAñadir" id="abrir" onclick="abrirModal(this.id,this.value);"><i class="fas fa-plus"></i> Añadir </button>
        </div>
        <br>

      

<div id="container">
<table id="tableID" class="styled-table">
    <thead>
    <tr>
        <th>ID MODULO</th>
        <th>NOMBRE</th>
        <th>DIRECTORIO</th>
        <th>Modificar</th>
        <th>Eliminar</th>
    </tr>
</thead>
    <?php foreach  ($lista as $modulo): ?>

        <tr>
            
            <td><?php echo $modulo->getIdModulo(); ?></td>
            <td><?php echo $modulo->getDescripcion(); ?></td>
            <td><?php echo $modulo->getDirectorio(); ?></td>
            <td><button style="outline:none;border:0;" type="button" id="abrir2" value="<?php echo $modulo->getIdModulo(); ?>"  onclick="abrirModal(this.id,this.value);"><i class="botonActualizar fas fa-edit"></i></button></td>
            <td><a href="eliminar.php?id_modulo=<?php echo $modulo->getIdModulo(); ?>"><i class="botonEliminar fas fa-trash"></i></a></td>

        </tr>

    <?php endforeach ?>

</table>
</div>
            <div id="miModal" class="modal">
            	<div class="flex" id="flex">
            		<div class="contenido-modal">
            			<div class="modal-header flex">
            				<h2>Añadir Nuevo Modulo</h2>
            				<span class="close" id="close">&times;</span>
            			</div>
            			<div class="modal-body">
            				<?php require_once "../../../modulos/configuracion/modulos/nuevo.php";?>

            			</div>

            		</div>
            	</div>
            </div>


            	<div id="miModal2" class="modal">
		<div class="flex" id="flex2">
			<div class="contenido-modal">
				<div class="modal-header flex">
					<h2>Modificar Modulo</h2>
					<span class="close" id="close2">&times;</span>
				</div>
				<div class="modal-body">
							<?php require_once "../../../modulos/configuracion/modulos/modificar.php";?>
				</div>

			</div>
		</div>
	</div>
        </div>






























<?php $perfilUsuario = $usuario->perfil->getDescripcion();
if($perfilUsuario == "ADMINISTRADOR"){ ?>

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

                            <a href="/programacion_3/boutique/modulos/configuracion/<?php echo $modulo4->getDirectorio(); ?>/listado.php" class="<?php echo $modulo4->getIcono(); ?>"></a>   
                            <span><?php echo $modulo4->getDescripcion(); ?></span>
                        </div>

                    <?php } ?>
                <?php endforeach ?>
                
            </div>


        </div>
    <?php } ?>
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