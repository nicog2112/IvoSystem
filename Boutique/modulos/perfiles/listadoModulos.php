<?php


require_once "../../class/Perfil.php";
require_once "../../class/PerfilModulo.php";
require_once "../../class/Modulo.php";

$listadoModulos = Modulo::obtenerTodos();
$id_perfil = $_GET["id"];
$perfil = Perfil::obtenerPorId($id_perfil);



?>

         
<form method="POST" action="procesar_altaModulos.php"  name="formulario" id="formulario">

    <input type="hidden" name="txtIdPerfil" value="<?php echo $id_perfil; ?>">

    <div id ="columnaModulos">

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



            <input type="checkbox" <?php echo $checked; ?>  value="<?php echo $modulo->getIdModulo(); ?>" name="chkl[ ]" class="mybox" >
            <label id="check"><?php echo $modulo->getDescripcion(); ?></label>
            <br>




        <?php endforeach ?>

    </div>
    <button type="cancel" name="Cancelar" class="botonCancelar"  onclick="window.location='/programacion_3/boutique/modulos/perfiles/listado.php';return false;">Cancelar</button>

    <input type="submit" name="Guardar" value="Guardar"  class="botonGuardar">

    <br>
</div>

</form>


 <script>
        $(".mybox").simpleSwitch();
    </script>


