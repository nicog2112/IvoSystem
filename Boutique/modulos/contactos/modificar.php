<?php

require_once "../../class/Contacto.php";
require_once "../../class/TipoContacto.php";

$listadoTipoContactos = TipoContacto::obtenerTodosActivos();

$idPersona = $_GET["id_persona"];
$id_persona_contacto = $_GET['id'];
$moduloMenu= $_GET['modulo'];
$idMenu= $_GET['idMenu'];

$contacto = Contacto::obtenerPorId($id_persona_contacto);


?>
<form method="POST" action="procesar_modificacion.php" class="form__reg" name="formulario" id="formularioModificar" >
		<input type="hidden" name="txtIdPersonaContacto" value="<?php echo $id_persona_contacto; ?>">
		<input type="hidden" name="txtId" value="<?php echo $idPersona; ?>">
    	<input type="hidden" name="moduloMenu" value="<?php echo $moduloMenu; ?>">
     	<input type="hidden" name="idMenu" value="<?php echo $idMenu; ?>">
	
			<div class="formulario__grupo" id="grupo__cboTipoContactoModificar" >
		<label for="cboTipoContactoModificar" class="formulario__label">Tipo de Contacto *</label>
		<div class="formulario__grupo-input">

			<select name="cboTipoContactoModificar" id="cboTipoContactoModificar" class="formulario__input">
				<option value="NULL">---Seleccionar---</option>

				<?php foreach ($listadoTipoContactos as $tipoContacto): ?>

					<?php

					$selected = "";

					if ($tipoContacto->getIdTipoContacto() == $contacto->getIdTipoContacto()) {
						$selected = "SELECTED";
					}

					?>

					<option <?php echo $selected; ?> value="<?php echo $tipoContacto->getIdTipoContacto(); ?>">
						<?php echo $tipoContacto->getDescripcion(); ?>
					</option>

				<?php endforeach ?>

			</select>
			<i class="formulario__validacion-estado fas fa-times-circle"></i>
		</div>	
		<p class="formulario__input-error">Debe seleccionar un tipo de contacto.</p>
	</div>
		<br>

	<div class="formulario__grupo" id="grupo__valorModificar">
				<label for="valorModificar" class="formulario__label">Valor *</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="valorModificar" id="valorModificar" value="<?php echo $contacto->getValor(); ?>">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error">El valor no puede estar vacio ni contener espacios</p>
			</div>
		<br>

		<div class="formulario__mensaje" id="formulario__mensaje">
			<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
		</div>
		<br>
		<div class="formulario__grupo formulario__grupo-btn-enviar">
			
			<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
			<br>
		</div>
		<button type="cancel" name="Cancelar" class="botonCancelar"  onclick="window.location='/programacion_3/boutique/modulos/proveedores/listado.php';return false;">Cancelar</button>
		
		<input type="submit" name="Guardar" value="Guardar"  class="botonGuardar">
		<br><br>
	</form>

