<?php

require_once "../../class/ContactoProveedor.php";
require_once "../../class/TipoContacto.php";

$listadoTipoContactos = TipoContacto::obtenerTodosActivos();

$idProveedor = $_GET["id_proveedor"];


$listadoContactos = ContactoProveedor::obtenerPorIdProveedor($idProveedor);



?>

<form method="POST" action="procesar_alta.php" class="form__reg" name="formulario" id="formularioAñadir" >
		<input type="hidden" name="txtIdProveedor" value="<?php echo $idProveedor;?>">
		
	
		<div class="formulario__grupo" id="grupo__cboTipoContactoNuevo" >
			<label for="cboTipoContactoNuevo" class="formulario__label">Tipo de Contacto *</label>
			<div class="formulario__grupo-input">
				
				<select name="cboTipoContacto" id="cboTipoContacto" class="formulario__input">
					<option value= NULL>-- Seleccionar --</option>

					<?php foreach ($listadoTipoContactos as $tipoContacto): ?>

						<option value="<?php echo $tipoContacto->getIdTipoContacto(); ?>">
							<?php echo $tipoContacto->getDescripcion(); ?>
						</option>

					<?php endforeach ?>

				</select>
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>	
			<p class="formulario__input-error">Debe seleccionar un tipo de contacto.</p>
		</div>
		<br>

		<div class="formulario__grupo" id="grupo__valorNuevo" >
			<label for="valorNuevo" class="formulario__label">Valor *</label>
			<div class="formulario__grupo-input">
				<input type="text" name="valorNuevo" id="valorNuevo" class="formulario__input">
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
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
		<button type="cancel" name="Cancelar" class="botonCancelar"  onclick="window.location='/programacion_3/boutique/modulos/contactosProveedores/listado.php?id_proveedor=<?php echo $idProveedor ?>';return false;">Cancelar</button>
		
		<input type="submit" name="Guardar" value="Guardar"  class="botonGuardar">
		<br><br>
	</form>
