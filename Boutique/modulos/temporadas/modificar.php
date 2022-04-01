
<?php

require_once "../../class/Temporada.php";


$id_temporada = $_GET["id"];

$temporada = Temporada::obtenerPorId($id_temporada);


?>


	<form method="POST" action="procesar_modificacion.php" class="form__reg" name="formularioModificar" id="formularioModificar">
		<input type="hidden" name="txtIdTemporada" value="<?php echo $id_temporada; ?>">

		
		<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">Nombre de la Temporada *</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" value="<?php echo $temporada->getNombre(); ?>">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error">El nombre de la Temporada tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
			</div>

						<br>
			

			<!-- Grupo: Año -->
			<div class="formulario__grupo" id="grupo__valorPorcentaje">
				<label for="valorPorcentaje" class="formulario__label">Año *</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="valorPorcentaje" id="valorPorcentaje" value="<?php echo $temporada->getAño(); ?>">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error">El año de la Temporada no puede estar vacio y tiene que ser de 4 dígitos</p>
			</div>


			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
			</div>
			<br>
			<div class="formulario__grupo formulario__grupo-btn-enviar">
				
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
				<br>
			</div>
			<button type="cancel" name="Cancelar" class="botonCancelar"  onclick="window.location='/programacion_3/boutique/modulos/temporadas/listado.php';return false;">Cancelar</button>
		
			<input type="submit" name="Guardar" value="Guardar"  class="botonGuardar">
			<br><br>
		</form>
	