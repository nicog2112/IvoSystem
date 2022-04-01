<?php

require_once "../../class/Usuario.php";
require_once "../../class/Sexo.php";
require_once "../../class/Perfil.php";
require_once "../../class/Cliente.php";
require_once "../../class/Empleado.php";

$listadoPerfil = Perfil::obtenerTodos();
$listadoSexo = Sexo::obtenerTodos();

$id_usuario = $_GET["id"];

$user = Usuario::obtenerPorId($id_usuario);



$listadoClientes = Cliente::obtenerTodosActivos();

$listadoEmpleados= Empleado::obtenerTodosActivos();
$idPerfilUsuario = $_GET["id_perfil_usuario"];
?>
<form method="POST" action="procesar_modificacion.php" class="form__reg" enctype="multipart/form-data" id="formularioModificar">

		<input type="hidden" name="idPerfilDeUsuario" id="idPerfilDeUsuario" value="<?php echo $idPerfilUsuario; ?>">
		<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $id_usuario; ?>">
			<?php

		if($idPerfilUsuario == 3){ 

			$mostrar= "block"; } 
		else{
			$mostrar="none";
		} 

		if($idPerfilUsuario != 3){
			$mostrar2= "block"; } 
		else{
			$mostrar2="none";
		} ?>
		
		<!-- Grupo: Cliente -->
		<div class="formulario__grupo" id="grupo__clienteModificar" style="display: <?php echo $mostrar; ?>;">
			<label for="clienteModificar" class="formulario__label">Cliente *</label>
			<div class="formulario__grupo-input">
				<select name="clienteModificar" id="clienteModificar" class="formulario__input" style="width:100%;">
					<option value="NULL">---Seleccionar---</option>

					<?php foreach ($listadoClientes as $cliente): ?>

						<?php

						$selected = "";

						if ($cliente->getIdPersona() == $user->getIdPersona()) {
							$selected = "SELECTED";
						}

						?>


						<option  <?php echo $selected; ?> value="<?php echo $cliente->getIdPersona(); ?>">
							<?php echo $cliente->getNombre(); echo " ";
							echo $cliente->getApellido(); echo " ";
							echo $cliente->getDNI();?>
						</option>
					<?php endforeach ?>

				</select>



				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
			<br>
			<p class="formulario__input-error">El cliente no puede estar vacio. Seleccione una opcion</p>
		</div>
		


		<!-- Grupo: Cliente -->
		<div class="formulario__grupo" id="grupo__EmpleadoModificar" style="display: <?php echo $mostrar2; ?>;">
			<label for="EmpleadoModificar" class="formulario__label">Empleado *</label>
			<div class="formulario__grupo-input">
				<select name="EmpleadoModificar" id="EmpleadoModificar" class="formulario__input" style="width:100%;">
					<option value="NULL">---Seleccionar---</option>

					<?php foreach ($listadoEmpleados as $empleado): ?>

						<?php

						$selected = "";

						if ($empleado->getIdPersona() == $user->getIdPersona()) {
							$selected = "SELECTED";
						}

						?>


						<option <?php echo $selected; ?> value="<?php echo $empleado->getIdPersona(); ?>">
							<?php echo $empleado->getNombre(); echo " ";
							echo $empleado->getApellido(); echo " ";
							echo $empleado->getDNI();?>
						</option>
					<?php endforeach ?>

				</select>
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
			<br>
			<p class="formulario__input-error">El cliente no puede estar vacio. Seleccione una opcion</p>
		</div>

			

			<!-- Grupo: Imagen -->
        <div class="formulario__grupo" id="grupo__imagen">
            <label for="Imagen" class="formulario__label">Imagen</label>
            <div class="formulario__grupo-input">
                <input type="file" class="formulario__input" id="files" name="Imagen" accept="image/*" value="<?php echo $user->getImagen(); ?>">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>

            <p class="formulario__input-error">La imagen tiene que ser jpg ,png</p>
        </div>

         <!-- Grupo: Usuario -->
            <div class="formulario__grupo" id="grupo__usernameModif">
                <label for="usernameModif" class="formulario__label">Usuario *</label>
                <div class="formulario__grupo-input">
                    <input type="text" class="formulario__input" name="usernameModif" id="usernameModif" value="<?php echo $user->getUsername(); ?>" >
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>

                <p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
            </div>

            <br>

            <!-- Grupo: Password -->
            <div class="formulario__grupo" id="grupo__passwordModif">
                <label for="passwordModif" class="formulario__label">Contraseña *</label>
                <div class="formulario__grupo-input">
                    <input type="password" class="formulario__input" name="passwordModif" id="passwordModif" value="<?php echo $user->getPassword(); ?>"  >
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>

                <p class="formulario__input-error">El apellido tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
            </div>

            <div class="formulario__mensaje" id="formulario__mensaje">
			<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
		</div>
		<br>
		<div class="formulario__grupo formulario__grupo-btn-enviar">
			
			<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
			<br>
		</div>
		<button type="cancel" name="Cancelar" class="botonCancelar"  onclick="window.location='/programacion_3/boutique/modulos/Usuario/listado.php';return false;">Cancelar</button>
		
		<input type="submit" name="Guardar" value="Guardar"  class="botonGuardar">
		<br><br>
	</form>
