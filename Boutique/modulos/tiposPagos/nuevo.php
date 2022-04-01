

			<form method="POST" action="procesar_alta.php" class="form__reg" name="formularioNuevo" id="formularioNuevo">
			
	

			<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombreNuevo">
				<label for="nombreNuevo" class="formulario__label">Nombre del tipo de Pago *</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombreNuevo" id="nombreNuevo">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>

				<p class="formulario__input-error">El nombre solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio</p>
			</div>

				<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__valorPorcentajeNuevo">
				<label for="valorPorcentajeNuevo" class="formulario__label">Porcentaje de Descuento *</label>
				<div class="formulario__grupo-input">
					<input type="number" class="formulario__input" name="valorPorcentajeNuevo" id="valorPorcentajeNuevo">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
	
				<p class="formulario__input-error">El valor debe ser positivo y no puede estar vacio</p>
			</div>

			
			<br>
			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
			</div>

			<div class="formulario__grupo formulario__grupo-btn-enviar">
				
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
				<br>
			</div>
			<button type="cancel" name="Cancelar" class="botonCancelar"  onclick="window.location='/programacion_3/boutique/modulos/tiposPagos/listado.php';return false;">Cancelar</button>
		
			<input type="submit" name="Guardar" value="Guardar"  class="botonGuardar">

				<br><br>
		</form>
