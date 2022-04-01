<?php

require_once "../../class/Cliente.php";
require_once "../../class/Sexo.php";

$listadoSexo = Sexo::obtenerTodos();

$id_cliente = $_GET["id"];

$cliente = Cliente::obtenerPorId($id_cliente);


?>



<div class="form-register__header">
	<ul class="progressbar">
		<li class="progressbar__option active" id="paso1Modificar">paso 1</li>
		<li class="progressbar__option" id="paso2Modificar">paso 2</li>
		<li class="progressbar__option" id="paso3Modificar">paso 3</li>
		<li class="progressbar__option" id="paso4Modificar">paso 4</li>
	</ul>

</div>
<form method="POST" action="procesar_modificacion.php"  enctype="multipart/form-data" class="form__reg" name="formulario" id="formularioModificar" novalidate>

	<div id="parte1Modificar" style="display:block;">

		<input type="hidden" name="txtIdEmpleado" value="<?php echo $id_cliente; ?>">
		
		<!-- Grupo: Nombre -->
		<div class="formulario__grupo" id="grupo__nombrePersonaModificar">
			<label for="nombrePersonaModificar" class="formulario__label">Nombre</label>
			<div class="formulario__grupo-input">
				<input type="text" class="formulario__input" name="nombrePersonaModificar" id="nombrePersonaModificar" value="<?php echo $cliente->getNombre(); ?>">
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>

			<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
		</div>

		<br>

		<!-- Grupo: Apellido -->
		<div class="formulario__grupo" id="grupo__apellidoPersonaModificar">
			<label for="apellidoPersonaModificar" class="formulario__label">Apellido</label>
			<div class="formulario__grupo-input">
				<input type="text" class="formulario__input" name="apellidoPersonaModificar" id="apellidoPersonaModificar"  value="<?php echo $cliente->getApellido(); ?>" >
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>

			<p class="formulario__input-error">El apellido tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
		</div>
		<br><br>
		<button type="button" onclick="HabilitarParte2Modificar();" class="botonGuardar">Siguiente</button>

		<br>
	</div>

	<div id="parte2Modificar" style="display:none;">

		<!-- Grupo: DNI -->
		<div class="formulario__grupo" id="grupo__dniPersonaModificar">
			<label for="dniPersonaModificar" class="formulario__label">DNI</label>
			<div class="formulario__grupo-input">
				<input type="number" class="formulario__input" name="dniPersonaModificar" id="dniPersonaModificar"  value="<?php echo $cliente->getDni(); ?>" >
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>

			<p class="formulario__input-error">El dni tiene que ser de 8 a 10 dígitos y no puede estar vacio</p>
		</div>
		<br>


		<!-- Grupo: FechaNacimiento -->
		<div class="formulario__grupo" id="grupo__fechaNacimientoPersonaModificar">
			<label for="fechaNacimientoPersonaModificar" class="formulario__label" >Fecha de Nacimiento</label>
			<div class="formulario__grupo-input">
				<input type="date" class="formulario__input" name="fechaNacimientoPersonaModificar" id="fechaNacimientoPersonaModificar"  value="<?php echo $cliente->getFechaNacimiento(); ?>">
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
			<br>
			<p class="formulario__input-error">La fecha es incorrecta</p>
		</div>  

		<br>
		<button type="button" onclick="HabilitarParte3Modificar();" class="botonGuardar">Siguiente</button>
		<button type="button" onclick="VolverParte1Modificar();" class="botonCancelar">Anterior</button>
		<br>
	</div>

	<div id="parte3Modificar" style="display:none;">
		<!-- Grupo: Sexo -->
		<div class="formulario__grupo" id="grupo__sexoPersonaModificar">
			<label for="sexoPersonaModificar" class="formulario__label">Sexo</label>
			<div class="formulario__grupo-input">
				<select name="sexoPersonaModificar" id="sexoPersonaModificar" class="formulario__input">
					<option value="NULL">---Seleccionar---</option>

					<?php foreach ($listadoSexo as $sexo): ?>

						<?php

						$selected = "";

						if ($sexo->getIdSexo() == $cliente->getIdSexo()) {
							$selected = "SELECTED";
						}

						?>

						<option <?php echo $selected; ?> value="<?php echo $sexo->getIdSexo(); ?>">
							<?php echo $sexo->getDescripcion(); ?>
						</option>

					<?php endforeach ?>
				</select>
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
			<br>
			<p class="formulario__input-error">El sexo no puede estar vacio. Seleccione una opcion</p>
		</div>

		<!-- Grupo: Nacionalidad -->
		<div class="formulario__grupo" id="grupo__nacionalidadPersonaModificar">
			<label for="nacionalidadPersonaModificar" class="formulario__label">Nacionalidad</label>
			<div class="formulario__grupo-input">
				<input type="text" class="formulario__input" name="nacionalidadPersonaModificar" id="nacionalidadPersonaModificar"  value="<?php echo $cliente->getNacionalidad(); ?>">
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
			<br>
			<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
		</div>





		<br>

		<button type="button" onclick="HabilitarParte4Modificar();" class="botonGuardar">Siguiente</button>
		<button type="button" onclick="VolverParte2Modificar();" class="botonCancelar">Anterior</button>
		<br>
	</div>




	<div id="parte4Modificar" style="display:none;">
		<h4>Verifique que los datos ingresados sean correctos</h4>
		<table class="styled-table" style="font-size: 0.9rem;">
			<thead>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>DNI</th>
				<th>Nacionalidad</th>
				<th>Fecha de Nacimiento</th>
				<th>Sexo</th>
				
			</thead>
			<tbody>
				<td><p id="mostrarNombrePersonaModificar"></p></td>
				<td><p id="mostrarApellidoPersonaModificar"></p></td>
				<td><p id="mostrarDNIPersonaModificar"></p></td>
				<td><p id="mostrarNacionalidadPersonaModificar"></p></td>
				<td><p id="mostrarFechaNacimientoPersonaModificar"></p></td>
				<td><p id="mostrarSexoPersonaModificar"></p></td>


			</tbody>
		</table>


		<br>
		<div class="formulario__mensaje" id="formulario__mensajeModificar">
			<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
		</div>
		<button type="button" onclick="VolverParte3Modificar();" class="botonCancelar">Anterior</button>

		<button type="submit" class="botonGuardar" id="btnActualizar">Guardar</button>
		<p class="formulario__mensaje-exito" id="formulario__mensaje-exitoModificar">Formulario enviado exitosamente!</p>
		<br>

	</div> 


</form>

