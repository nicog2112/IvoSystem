<?php

require_once "../../class/Perfil.php";


$id_perfil = $_GET["id"];

$perfil = Perfil::obtenerPorId($id_perfil);



?>


	<form method="POST" action="procesar_modificacion.php"  class="form__reg" name="formularioModificar" id="formularioModificar">

		<input type="hidden" name="txtIdPerfil" value="<?php echo $id_perfil; ?>">
	

			     <!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">Nombre *</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" value="<?php echo $perfil->getDescripcion(); ?>" >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
	
				<p class="formulario__input-error">El nombre solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio</p>
			</div>

			
			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
			</div>

			<div class="formulario__grupo formulario__grupo-btn-enviar">
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
				<br>
			</div>
			<button type="cancel" name="Cancelar" class="botonCancelar"  onclick="window.location='/programacion_3/boutique/modulos/perfiles/listado.php';return false;">Cancelar</button>
		
			<input type="submit" name="Guardar" value="Guardar"  class="botonGuardar">
		<br><br>
		</form>
		
