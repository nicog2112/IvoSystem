<?php

require_once "../../class/Localidad.php";


$id_provincia = $_GET["id_provincia"];
$id_localidad = $_GET["id"];

$localidad = Localidad::obtenerPorIdLocalidad($id_localidad);






?>

	<form method="POST" action="procesar_modificacionLocalidad.php"  class="form__reg" name="formularioModificar" id="formularioModificar">

		<input type="hidden" name="txtIdLocalidad" value="<?php echo $id_localidad; ?>">

	     <input type="hidden" name="txtIdProvincia" value="<?php echo $id_provincia; ?>">

	     <!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">Nombre de la Localidad *</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" value="<?php echo $localidad->getDescripcion(); ?>" >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
			
				<p class="formulario__input-error">El nombre solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio</p>
			</div>

			
			<br>
			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
			</div>

			<div class="formulario__grupo formulario__grupo-btn-enviar">
				
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
				<br>
			</div>

			<button type="cancel" name="Cancelar" class="botonCancelar"  onclick="window.location='/programacion_3/boutique/modulos/configuracionDomicilio/listadoLocalidad.php?id_provincia=<?php echo $id_provincia; ?>';return false;">Cancelar</button>
		
			<input type="submit" name="Guardar" value="Guardar"  class="botonGuardar">
		<br><br>
		</form>
		
