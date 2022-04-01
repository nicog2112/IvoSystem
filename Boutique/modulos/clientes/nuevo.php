<?php

$fcha = date("Y-m-d");

$mensaje = "";
$mensaje1 = "";
$mensaje2 = "";
$mensaje3 = "";
$mensaje4 = "";
$mensaje5 = "";
$mensaje6 = "";
$mensaje7 = "";
$mensaje8 = "";


if (isset($_GET["error"])) {
	// code...
	switch ($_GET["error"]) {

	case 'nombre':
		$mensaje1 = "<div class='error'>"."El nombre no debe estar vacio y debe tener minimo 3 caracteres"."</div>";
		break;


	case 'apellido':
		$mensaje2 = "<div class='error'>"."El apellido no debe estar vacio y debe tener minimo 3 caracteres"."</div>";
		break;

	case 'dni':
		$mensaje3= "<div class='error'>"."El dni no debe estar vacio y debe tener maximo 8 caracteres"."</div>";
		break;

	case 'legajo':
		$mensaje4= "<div class='error'>"."El nro de legajo no debe estar vacio, solo se permiten letras y debe tener minimo 5 caracteres"."</div>";
		break;

	case 'fechaNacimiento':
		$mensaje5= "<div class='error'>"."La fecha de Nacimiento tiene que ser menor a la fecha actual"."</div>";
		break;

	case 'sexo':
		$mensaje6= "<div class='error'>"."El sexo no puede estar vacio"."</div>";
		break;

	case 'nacionalidad':
		$mensaje7= "<div class='error'>"."La nacionalidad no debe estar vacio, solo se permiten letras y debe tener minimo 5 caracteres"."</div>";
		break;

	case 'cargo':
		$mensaje8= "<div class='error'>"."El cargo no debe estar vacio, solo se permiten letras y debe tener minimo 3 caracteres"."</div>";
		break;

	case 'false':
		$mensaje = "<div class='correcto'>"."Datos correctos"."</div>";
		sleep(10);
		break;


}


}


?>
<?php

require_once "../../class/Sexo.php";
require_once "../../class/Persona.php";

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
		<button type="button" onclick="VolverParte3Nuevo();" class="botonCancelar">Anterior</button>

		<button type="submit" class="botonGuardar">Guardar</button>
		<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
		<br>




</form>
