<?php


require_once "../../class/Provincia.php";


$id_pais = $_GET["id"];

?>

			<form method="POST" action="procesar_altaProvincia.php" class="form__reg" name="formularioNuevo" id="formularioNuevo">
			
			<input type="hidden" name="txtIdPais" value="<?php echo $id_pais; ?>">

			<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombreNuevo">
				<label for="nombreNuevo" class="formulario__label">Nombre de la Provincia *</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombreNuevo" id="nombreNuevo" placeholder="Argentina">
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
			<button type="cancel" name="Cancelar" class="botonCancelar"  onclick="window.location='/programacion_3/boutique/modulos/configuracionDomicilio/listadoProvincia.php?id_pais=<?php echo $id_pais; ?>';return false;">Cancelar</button>
		
			<input type="submit" name="Guardar" value="Guardar"  class="botonGuardar">
		<br><br>
		</form>

