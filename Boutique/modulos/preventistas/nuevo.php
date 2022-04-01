<?php

require_once "../../class/Sexo.php";

require_once "../../class/Proveedor.php";
require_once "../../class/Persona.php";

$id_proveedor = $_GET["id"];


$listadoSexo = Sexo::obtenerTodos();
$listadoPersonas= Persona::obtenerTodosActivos();

?>

<script type="text/javascript">
    jQuery(document).ready(function($){
    $(document).ready(function() {
        $('#personaAñadir').select2();
    });
});
</script>

<form method="POST" action="procesar_alta.php"  enctype="multipart/form-data" class="form__reg" name="formulario" id="formularioNuevo">

	

		<input type="hidden" name="txtIdProveedor" id="proveedor" value="<?php echo $id_proveedor; ?>">
		<!-- Grupo: Sexo -->
		<div class="formulario__grupo" id="grupo__personaAñadir">
			<label for="personaAñadir" class="formulario__label">Persona *</label>
			<div class="formulario__grupo-input">
				<select name="personaAñadir" id="personaAñadir" class="formulario__input" required>
					<option value="">---Seleccionar---</option>

					<?php foreach ($listadoPersonas as $persona): ?>


						<option value="<?php echo $persona->getIdPersona(); ?>">
							<?php echo $persona->getNombre();
							echo " ";
							echo $persona->getApellido();
							echo " DNI: ";
							echo $persona->getDni(); ?>
						</option>
					<?php endforeach ?>

				</select>
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>

			<p class="formulario__input-error">Seleccione una opcion</p>
		</div>
		


		<br>
		<div class="formulario__mensaje" id="formulario__mensaje">
			<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
		</div>
		<br>
		<div class="formulario__grupo formulario__grupo-btn-enviar">
			
			<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Registro Insertado Exitosamente!</p>
			<br>
		</div>
		<button type="button" onclick="VolverParte3Nuevo();" class="botonCancelar">Anterior</button>

		<button type="submit" class="botonGuardar">Guardar</button>
		
		<br>


</form>
