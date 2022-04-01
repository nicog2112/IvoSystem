<?php

require_once "configs.php";

require_once "../../../class/Usuario.php";
require_once "../../../class/ProductoTalle.php";

require_once "../../../class/Perfil.php";
require_once "../../../class/PerfilModulo.php";
require_once "../../../class/Modulo.php";

$listadoModulos = Modulo::obtenerTodos();
$id_perfil = $_GET["id_perfil"];
$perfil = Perfil::obtenerPorId($id_perfil);



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
        <link rel="stylesheet" href="/programacion_3/boutique/css/formularioNUEVO.css">
        <style type="text/css">
            .columnas{
                 margin-bottom: 30px;
    padding:5px 0 5px 300px;
    display: block;
           
                column-count: 2;

                


               

            }
            #check{
                 display: block;
                 float: left;
                 margin: auto;
            }

            .checkbox-switch {
     cursor: pointer;
    display: block;
    overflow: hidden;
    position: relative;
    text-align: left;
    width: 80px;
    height: 30px;
    -webkit-border-radius: 30px;
    border-radius: 30px;
    line-height: 1.2;
    font-size: 12px;
    margin: auto;

}

.checkbox-switch input.input-checkbox {
    position: absolute;
    left: 0;
    top: 0;
    width: 80px;
    height: 30px;
    padding: 0;
    margin: 0;
    opacity: 0;
    z-index: 2;
    cursor: pointer;
}

.checkbox-switch .checkbox-animate {
    position: relative;
    width: 80px;
    height: 30px;
    background-color: #95a5a6;
    -webkit-transition: background 0.25s ease-out 0s;
    transition: background 0.25s ease-out 0s;
}

.checkbox-switch .checkbox-animate:before {
    content: "";
    display: block;
    position: absolute;
    width: 20px;
    height: 20px;
    border-radius: 10px;
    -webkit-border-radius: 10px;
    background-color: #7f8c8d;
    top: 5px;
    left: 5px;
     -webkit-transition: left 0.3s ease-out 0s;
    transition: left 0.3s ease-out 0s;
    z-index: 10;
}

.checkbox-switch input.input-checkbox:checked + .checkbox-animate {
    background-color: #2ecc71;
}

.checkbox-switch input.input-checkbox:checked + .checkbox-animate:before {
    left: 55px;
    background-color: #27ae60;
}

.checkbox-switch .checkbox-off,
.checkbox-switch .checkbox-on {
    float: left;
    color: #fff;
    font-weight: 700;
    padding-top: 6px;
     -webkit-transition: all 0.3s ease-out 0s;
    transition: all 0.3s ease-out 0s;
}

.checkbox-switch .checkbox-off {
    margin-left: 30px;
    opacity: 1;
}

.checkbox-switch .checkbox-on {
    display: none;
    float: right;
    margin-right: 35px;
    opacity: 0;
}

.checkbox-switch input.input-checkbox:checked + .checkbox-animate .checkbox-off {
    display: none;
    opacity: 0;
}

.checkbox-switch input.input-checkbox:checked + .checkbox-animate .checkbox-on {
    display: block;
    opacity: 1;
}
        </style>
        
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

      

         
            <form method="POST" action="procesar_altaModulos.php"  name="formulario" id="formulario">
                    
                    <input type="hidden" name="txtIdPerfil" value="<?php echo $id_perfil; ?>">
                    <div class="columnas">

                    <?php foreach ($listadoModulos as $modulo): 
                        ?>

                    <?php

                    $checked = '';

                    foreach ($perfil->getModulos() as $perfilModulo) {
                        if ($modulo->getIdModulo() == $perfilModulo->getIdModulo()) {
                            $checked = "checked";
                        }
                    }

                    ?>
                     <label id="check"><?php echo $modulo->getDescripcion(); ?></label>
                   
                    <div class="checkbox-switch">
                        <input type="checkbox" <?php echo $checked; ?> onchange="T.toggleToobarStatus()" value="<?php echo $modulo->getIdModulo(); ?>" name="chkl[ ]" class="input-checkbox" id="toolbar-active">
                       <div class="checkbox-animate">
                          <span class="checkbox-off">OFF</span>
                          <span class="checkbox-on">ON</span>
                      </div>
                        
                  </div>
                  <br>
                   
                      
                    <?php endforeach ?>
                     </div>
                    
                    <br>
                    <div class="formulario__grupo formulario__grupo-btn-enviar">
                <button type="submit" class="formulario__btn" >Enviar</button>
                
                <br>
            </div>

            </form>

































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