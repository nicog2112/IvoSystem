<?php


require_once "../../class/Categoria.php";
$idCategoria= $_GET['id'];

$categoria = Categoria::obtenerPorId($idCategoria);





?>


	

	<form method="POST" action="procesar_modificacion.php"  class="form__reg" name="formularioModificar" id="formularioModificar">

		<input type="hidden" name="txtIdCategoria" id="id"  value="<?php echo $idCategoria; ?>">

			

	     <!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">Nombre *</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" value="<?php echo $categoria->getNombre(); ?>" >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 caracteres y solo puede contener letras</p>
			</div>

		
			<br>
			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
			</div>

			<div class="formulario__grupo formulario__grupo-btn-enviar">
				<br>
				
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
				<br>
			</div>
			<button type="cancel" name="Cancelar" class="botonCancelar"  onclick="window.location='/programacion_3/boutique/modulos/categorias/listado.php';return false;">Cancelar</button>
		
		<input type="submit" name="Guardar" value="Guardar"  class="botonGuardar">
		<br><br>

		
	</form>

		


