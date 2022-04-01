<?php

require_once "../../class/TiposImpositivos.php";


$id_tipo_impositivo = $_GET["id"];

$TipoImpositivo = TiposImpositivos::obtenerPorId($id_tipo_impositivo);





?>

	

	<form method="POST" action="procesar_modificacion.php"  class="form__reg" name="formularioModificar" id="formularioModificar">

		<input type="hidden" name="txtIdTipoImpuesto" value="<?php echo $id_tipo_impositivo; ?>">

	

			<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">Nombre del tipo de Impuesto *</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" value="<?php echo $TipoImpositivo->getDescripcion(); ?>">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error">El nombre solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio</p>
			</div>

				<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__valorPorcentaje">
				<label for="valorPorcentaje" class="formulario__label">Valor en Porcentaje del Impuesto *</label>
				<div class="formulario__grupo-input">
					<input type="number" class="formulario__input" name="valorPorcentaje" id="valorPorcentaje" value="<?php echo $TipoImpositivo->getValorPorcentaje(); ?>">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
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
			<button type="cancel" name="Cancelar" class="botonCancelar"  onclick="window.location='/programacion_3/boutique/modulos/tiposImpositivos/listado.php';return false;">Cancelar</button>
		
			<input type="submit" name="Guardar" value="Guardar"  class="botonGuardar">

				<br><br>

		
	</form>
