<?php

require_once "../../class/Sexo.php";

require_once "../../class/Proveedor.php";



$listadoSexo = Sexo::obtenerTodos();

?>





<div class="form-register__header">
	<ul class="progressbar">
		<li class="progressbar__option active" id="paso1Nuevo">paso 1</li>
		<li class="progressbar__option" id="paso2Nuevo">paso 2</li>
		<li class="progressbar__option" id="paso3Nuevo">paso 3</li>
		<li class="progressbar__option" id="paso4Nuevo">paso 4</li>
	</ul>

</div>
<form method="POST" action="procesar_alta.php"  enctype="multipart/form-data" class="form__reg" name="formulario" id="formularioNuevo">

	<div id="parte1Nuevo" style="display:block;">


		<!-- Grupo: Nombre -->
		<div class="formulario__grupo" id="grupo__nombrePersona">
			<label for="nombrePersona" class="formulario__label">Nombre *</label>
			<div class="formulario__grupo-input">
				<input type="text" class="formulario__input" name="nombrePersona" id="nombrePersona">
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>

			<p class="formulario__input-error">El nombre de la Persona solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio</p>
		</div>

		<br>

		<!-- Grupo: Apellido -->
		<div class="formulario__grupo" id="grupo__apellidoPersona">
			<label for="apellidoPersona" class="formulario__label">Apellido *</label>
			<div class="formulario__grupo-input">
				<input type="text" class="formulario__input" name="apellidoPersona" id="apellidoPersona" >
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>

			<p class="formulario__input-error">El apellido de la persona solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio</p>
		</div>
		<br>
		<!-- Grupo: DNI -->
		<div class="formulario__grupo" id="grupo__dniPersona">
			<label for="dniPersona" class="formulario__label">DNI *</label>
			<div class="formulario__grupo-input">
				<input type="number" class="formulario__input" name="dniPersona" id="dniPersona"  >
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>

			<p class="formulario__input-error">El DNI de la persona tiene que ser de 8 a 11 dígitos y solo puede contener numeros.</p>
		</div>
			<br><br>
		<button type="button" onclick="HabilitarParte2Nuevo();" class="botonGuardar">Siguiente</button>

		<br>
	</div>

	<div id="parte2Nuevo" style="display:none;">

		<!-- Grupo: Sexo -->
		<div class="formulario__grupo" id="grupo__sexoPersona">
			<label for="sexoPersona" class="formulario__label">Sexo</label>
			<div class="formulario__grupo-input">
				<select name="sexoPersona" id="sexoPersona" class="formulario__input">
					<option value="NULL">---Seleccionar---</option>

					<?php foreach ($listadoSexo as $sexo): ?>


						<option value="<?php echo $sexo->getIdSexo(); ?>">
							<?php echo $sexo->getDescripcion(); ?>
						</option>
					<?php endforeach ?>

				</select>
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>

			<p class="formulario__input-error">Seleccione una opcion</p>
		</div>
		<br>
		<!-- Grupo: Nacionalidad -->
		<div class="formulario__grupo" id="grupo__nacionalidadPersona">
			<label for="nacionalidadPersona" class="formulario__label">Nacionalidad</label>
			<div class="formulario__grupo-input">
				<input type="text" class="formulario__input" name="nacionalidadPersona" id="nacionalidadPersona" value="Argentina">
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
		
			<p class="formulario__input-error">La nacionalidad de la persona solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio.</p>
		</div>
		<br>
		<!-- Grupo: FechaNacimiento -->
		<div class="formulario__grupo" id="grupo__fechaNacimientoPersona">
			<label for="fechaNacimientoPersona" class="formulario__label" >Fecha de Nacimiento</label>
			<div class="formulario__grupo-input">
				<input type="date" class="formulario__input" name="fechaNacimientoPersona" id="fechaNacimientoPersona">
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
			<p class="formulario__input-error">La fecha es incorrecta</p>
		</div>  

		<br><br>
		<button type="button" onclick="HabilitarParte3Nuevo();" class="botonGuardar">Siguiente</button>
		<button type="button" onclick="VolverParte1Nuevo();" class="botonCancelar">Anterior</button>
		<br>
	</div>

	<div id="parte3Nuevo" style="display:none;">
		<div>
			<label style="margin-left:300px;">Añadir a Empleados</label>
			<input type="checkbox" name="checkEmpleado" id="checkEmpleado" class="cm-toggle" style="margin-left:80px;" onchange="HabilitarLegajo(this);">
			<br>
			   <!-- Grupo: Legajo -->
            <div class="formulario__grupo" id="grupo__legajoNuevo" style="visibility:hidden;">
                <label for="legajoNuevo" class="formulario__label">Legajo</label>
                <div class="formulario__grupo-input">
                    <input type="number" class="formulario__input" name="legajoNuevo" id="legajoNuevo">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>

                <p class="formulario__input-error">El legajo solo puede contener numeros</p>
            </div>
            <br>
			<label style="margin-left:300px;">Añadir a Clientes</label>
		 	<input type="checkbox" name="checkCliente" id="checkCliente" class="cm-toggle" style="margin-left:105px;">
		 	<br>
			
		</div>
		


	


		<br><br>

		<button type="button" onclick="HabilitarParte4Nuevo();" class="botonGuardar">Siguiente</button>
		<button type="button" onclick="VolverParte2Nuevo();" class="botonCancelar">Anterior</button>
		<br>
	</div>




	<div id="parte4Nuevo" style="display:none;">
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
				<td><p id="mostrarNombrePersona"></p></td>
				<td><p id="mostrarApellidoPersona"></p></td>
				<td><p id="mostrarDNIPersona"></p></td>
				<td><p id="mostrarNacionalidadPersona"></p></td>
				<td><p id="mostrarFechaNacimientoPersona"></p></td>
				<td><p id="mostrarSexoPersona"></p></td>
			

			</tbody>
		</table>


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

	</div> 


</form>
