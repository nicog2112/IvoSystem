<?php


require_once "../../class/PersonaDomicilio.php";
require_once "../../class/Empleado.php";
require_once "../../class/Pais.php";
require_once "../../class/Provincia.php";
require_once "../../class/Localidad.php";
require_once "../../class/Barrio.php";

$listadoPais = Pais::obtenerTodosActivos();
$listadoProvincia = Provincia::obtenerTodos();
$listadoLocalidad = Localidad::obtenerTodos();
$listadoBarrio = Barrio::obtenerTodos();

$id_persona_domicilio = $_GET['id'];
$persona= $_GET['id_persona'];
$moduloMenu= $_GET['modulo'];
$idMenu= $_GET['idMenu'];
//$modulo = $_GET['modulo'];
///

///switch ($modulo) {

	///case 'empleados':
		///$persona = Empleado::obtenerPorIdPersona($idPersona);
		//break;

	//case 'clientes':
		// $persona = Cliente::obtenerPorIdPersona($idPersona); No
	  //  echo "viene de clientes";
	   // exit;
		//break;
	
	//default:
	//	echo "Modulo no valido";
	//	exit;

//}


$domicilio = PersonaDomicilio::obtenerPorIdPD($id_persona_domicilio);


//highlight_string(var_export($listadoDomicilios, true));


?>
<div class="form-register__header">
    <ul class="progressbar">
        <li class="progressbar__option active" id="paso1Modificar">paso 1</li>
        <li class="progressbar__option" id="paso2Modificar">paso 2</li>
        <li class="progressbar__option" id="paso3Modificar">paso 3</li>
        <li class="progressbar__option" id="paso4Modificar">paso 4</li>
    </ul>

</div>
<form method="POST" action="procesar_modificacion.php"  enctype="multipart/form-data" class="form__reg" name="formulario" id="formularioModificar">
	<input type="hidden" name="txtIdPersonaDomicilio" value="<?php echo $id_persona_domicilio; ?>">
	<input type="hidden" name="txtId" value="<?php echo $persona; ?>">
    <input type="hidden" name="moduloMenu" value="<?php echo $moduloMenu; ?>">
     <input type="hidden" name="idMenu" value="<?php echo $idMenu; ?>">

    <div id="parte1Modificar" style="display:block;">
         

        <!-- Grupo: Pais -->
        <div class="formulario__grupo" id="grupo__paisModificar">
        	<label for="paisModificar" class="formulario__label">Pais</label>
        	<div class="formulario__grupo-input">
        		<select id="paisModificar" name="paisModificar" class="formulario__input">
        			<option value=0>-- SELECCIONE --</option>

					<?php foreach ($listadoPais as $pais): ?>

				<?php

		    	$selected = "";

		    	if ($pais->getIdPais() == $domicilio->barrio ->localidad->provincia->pais->getIdPais()) {
		    		$selected = "SELECTED";
		    	}

		    	?>

				<option <?php echo $selected; ?> value="<?php echo $pais->getIdPais(); ?>">
					<?php echo $pais->getDescripcion(); ?>
				</option>
			
					<?php endforeach ?>
        		</select>
        		<i class="formulario__validacion-estado fas fa-times-circle"></i>
        	</div>

        	<p class="formulario__input-error">El pais es obligatorio</p>
        </div>

        <!-- Grupo: Provincia -->
        <div class="formulario__grupo" id="grupo__provinciaModificar">
            <label for="provinciaModificar" class="formulario__label">Provincia</label>
            <div class="formulario__grupo-input">
            	<select id="provinciaModificar" class="formulario__input" name="provinciaModificar" required>
      			<option value=0>-- SELECCIONE --</option>

    			<?php foreach ($listadoProvincia as $provincia): ?>

    			<?php

		    	$selected = "";

		    	if ($provincia->getIdProvincia() == $domicilio->barrio ->localidad->provincia->getIdProvincia()) {
		    		$selected = "SELECTED";
		    	}

		    	?>
      			<option <?php echo $selected; ?> value="<?php echo $provincia->getIdProvincia(); ?>">
					<?php echo $provincia->getDescripcion(); ?>
				</option>
				<?php endforeach ?>
   			</select>
               
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>

            <p class="formulario__input-error">La Provincia es obligatoria</p>
        </div>


        <!-- Grupo: Localidad -->
        <div class="formulario__grupo" id="grupo__localidadModificar">
        	<label for="localidadModificar" class="formulario__label">Localidad</label>
        	<div class="formulario__grupo-input">
        		<select id="localidadModificar" class="formulario__input" name="localidadModificar" required>
        			<option value=0>-- SELECCIONE --</option>

    			<?php foreach ($listadoLocalidad as $localidad): ?>

    			<?php

		    	$selected = "";

		    	if ($localidad->getIdLocalidad() == $domicilio->barrio ->localidad->getIdLocalidad()) {
		    		$selected = "SELECTED";
		    	}

		    	?>
      			<option <?php echo $selected; ?> value="<?php echo $localidad->getIdLocalidad(); ?>">
					<?php echo $localidad->getDescripcion(); ?>
				</option>
				<?php endforeach ?>
        		</select>
        		<i class="formulario__validacion-estado fas fa-times-circle"></i>
        	</div>

        	<p class="formulario__input-error">La localidad es obligatoria</p>
        </div>

         <!-- Grupo: Barrio -->
        <div class="formulario__grupo" id="grupo__barrioModificar">
        	<label for="barrioModificar" class="formulario__label">Barrio</label>
        	<div class="formulario__grupo-input">
        		<select id="barrioModificar" class="formulario__input" name="barrioModificar" required>
      			<option value=0>-- SELECCIONE --</option>

    			<?php foreach ($listadoBarrio as $barrio): ?>

    			<?php

		    	$selected = "";

		    	if ($barrio->getIdBarrio() == $domicilio->barrio ->getIdBarrio()) {
		    		$selected = "SELECTED";
		    	}

		    	?>
      			<option <?php echo $selected; ?> value="<?php echo $barrio->getIdBarrio(); ?>">
					<?php echo $barrio->getDescripcion(); ?>
				</option>
				<?php endforeach ?>
   			</select>
        		<i class="formulario__validacion-estado fas fa-times-circle"></i>
        	</div>

        	<p class="formulario__input-error">El barrio es obligatorio</p>
        </div>

        <br>
        <button type="button" onclick="HabilitarParte2Modificar();" class="botonGuardar">Siguiente</button>

        <br>
    </div>

    <div id="parte2Modificar" style="display:none;">

        <!-- Grupo: Calle -->
        <div class="formulario__grupo" id="grupo__calleModificar">
            <label for="calleModificar" class="formulario__label">Calle</label>
            <div class="formulario__grupo-input">
            	<input type="text" name="calleModificar" id="calleModificar" placeholder="Calle" class="formulario__input" value="<?php echo $domicilio->getCalle(); ?>">
            
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>

            <p class="formulario__input-error">Error de calle</p>
        </div>
        <br>

        <!-- Grupo: Altura -->
        <div class="formulario__grupo" id="grupo__alturaModificar">
            <label for="alturaModificar" class="formulario__label">Altura</label>
            <div class="formulario__grupo-input">
            	<input type="text" name="alturaModificar" id="alturaModificar" placeholder="Altura" class="formulario__input" value="<?php echo $domicilio->getAltura(); ?>">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <br>
            <p class="formulario__input-error">Error de Altura</p>
        </div>

        <!-- Grupo: Manzana -->
        <div class="formulario__grupo" id="grupo__manzanaModificar">
            <label for="manzanaModificar" class="formulario__label" >Manzana</label>
            <div class="formulario__grupo-input">
            	<input type="text" name="manzanaModificar" id="manzanaModificar"  placeholder="Manzana" class="formulario__input" value="<?php echo $domicilio->getManzana(); ?>">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <br>
            <p class="formulario__input-error">La manzana introducida no es valida</p>
        </div>  

        <br>
        <button type="button" onclick="HabilitarParte3Modificar();" class="botonGuardar">Siguiente</button>
        <button type="button" onclick="VolverParte1Modificar();" class="botonCancelar">Anterior</button>
        <br>
    </div>

    <div id="parte3Modificar" style="display:none;">

        <!-- Grupo: Casa -->
        <div class="formulario__grupo" id="grupo__casaModificar">
            <label for="casaNuevo" class="formulario__label">Casa</label>
            <div class="formulario__grupo-input">
                <input type="text" name="casaModificar" id="casaModificar"  placeholder="Casa" class="formulario__input" value="<?php echo $domicilio->getNumeroCasa(); ?>">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <br>
                <p class="formulario__input-error">La casa introducida es incorrecta</p>
            </div>

            <!-- Grupo: Torre -->
            <div class="formulario__grupo" id="grupo__torreModificar">
                <label for="torreNuevo" class="formulario__label">Torre</label>
                <div class="formulario__grupo-input">
                   <input type="text" name="torreModificar" id="torreModificar" placeholder="Torre" class="formulario__input" value="<?php echo $domicilio->getTorre(); ?>">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>

                <p class="formulario__input-error">La torre introducida es incorrecta</p>
            </div>

            <br>

            <!-- Grupo: Piso -->
            <div class="formulario__grupo" id="grupo__pisoModificar">
                <label for="pisoModificar" class="formulario__label">Piso</label>
                <div class="formulario__grupo-input">
                    <input type="text" name="pisoModificar"id="pisoModificar" placeholder="Piso" class="formulario__input" value="<?php echo $domicilio->getPiso(); ?>">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>

                <p class="formulario__input-error">El piso introducido es incorrecto</p>
            </div>




            <br><br>

            <button type="button" onclick="HabilitarParte4Modificar();" class="botonGuardar">Siguiente</button>
            <button type="button" onclick="VolverParte2Modificar();" class="botonCancelar">Anterior</button>
            <br>
        </div>




        <div id="parte4Modificar" style="display:none;">
            <h4>Verifique que los datos ingresados sean correctos</h4>
            <table class="styled-table" style="font-size: 0.9rem;">
                <thead>
                    <th>Pais</th>
                    <th>Provincia</th>
                    <th>Localidad</th>
                    <th>Barrio</th>
                    <th>Calle</th>
                    <th>Altura</th>
                    <th>Manzana</th>
                    <th>Casa</th>
                    <th>Torre</th>
                    <th>Piso</th>

                </thead>
                <tbody>
                    <td><p id="mostrarPaisModificar"></p></td>
                    <td><p id="mostrarProvinciaModificar"></p></td>
                    <td><p id="mostrarLocalidadModificar"></p></td>
                    <td><p id="mostrarBarrioModificar"></p></td>
                    <td><p id="mostrarCalleModificar"></p></td>
                    <td><p id="mostrarAlturaModificar"></p></td>
                    <td><p id="mostrarManzanaModificar"></p></td>
                    <td><p id="mostrarCasaModificar"></p></td>
                    <td><p id="mostrarTorreModificar"></p></td>
                    <td><p id="mostrarPisoModificar"></p></td>

                </tbody>
            </table>


            <br>
            <div class="formulario__mensaje" id="formulario__mensaje">
                <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
            </div>
            <button type="button" onclick="VolverParte3Modificar();" class="botonCancelar">Anterior</button>

            <button type="submit" class="botonGuardar">Guardar</button>
            <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
            <br>

        </div> 


    </form>
</div>

