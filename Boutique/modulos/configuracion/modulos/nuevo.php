

	<form method="POST" action="procesar_alta.php" class="form__reg" name="formulario" id="formulario">

		<?php
	
				echo $mensaje1;

				?>

			<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">Nombre del modulo:</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Empleado">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
			</div>

			<?php
	
				echo $mensaje2;

				?>
		
		<!-- Grupo: directorio -->
			<div class="formulario__grupo" id="grupo__directorio">
				<label for="directorio" class="formulario__label">Directorio</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="directorio" id="directorio" placeholder="Empleado">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error">El directorio tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
			</div>

			<br>
			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
			</div>

			<div class="formulario__grupo formulario__grupo-btn-enviar">
				<button type="submit" class="formulario__btn" >Enviar</button>
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
				<br>
			</div>
		</form>

