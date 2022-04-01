<?php

require_once "../../class/Sexo.php";
require_once "../../class/Perfil.php";
require_once "../../class/Cliente.php";
require_once "../../class/Empleado.php";

$listadoPerfil = Perfil::obtenerTodos();

$listadoSexo = Sexo::obtenerTodos();
$listadoClientes = Cliente::obtenerTodosActivos();

$listadoEmpleados= Empleado::obtenerTodosActivos();
$idPerfilUsuario = $_GET["id"];
?>




	<form method="POST" action="procesar_alta.php" class="form__reg" enctype="multipart/form-data" id="formularioNuevo" name="formularioNuevo">

		<input type="hidden" name="idPerfilDeUsuario" id="idPerfilDeUsuario" value="<?php echo $idPerfilUsuario; ?>">
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
		<div class="formulario__grupo" id="grupo__cliente" style="display: <?php echo $mostrar; ?>;">
			<label for="cliente" class="formulario__label">Cliente *</label>
			<div class="formulario__grupo-input">
				<select name="cliente" id="cliente" class="formulario__input"  style="width:100%;">
					<option value="NULL">---Seleccionar---</option>

					<?php foreach ($listadoClientes as $cliente): ?>


						<option value="<?php echo $cliente->getIdPersona(); ?>">
							<?php echo $cliente->getNombre(); echo " ";
							echo $cliente->getApellido(); echo " ";
							echo $cliente->getDNI();?>
						</option>
					<?php endforeach ?>

				</select>
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>

			<p class="formulario__input-error">El cliente no puede estar vacio. Seleccione una opcion</p>
		</div>
		


		<!-- Grupo: Cliente -->
		<div class="formulario__grupo" id="grupo__Empleado" style="display: <?php echo $mostrar2; ?>;">
			<label for="Empleado" class="formulario__label">Empleado *</label>
			<div class="formulario__grupo-input">
				<select name="Empleado" id="Empleado" class="formulario__input"  style="width:100%;">
					<option value="NULL">---Seleccionar---</option>

					<?php foreach ($listadoEmpleados as $empleado): ?>


						<option value="<?php echo $empleado->getIdPersona(); ?>">
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
                <input type="file" class="formulario__input" id="files" name="Imagen" accept="image/*">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>

            <p class="formulario__input-error">La imagen tiene que ser jpg ,png</p>
        </div>

         <!-- Grupo: Usuario -->
            <div class="formulario__grupo" id="grupo__username">
                <label for="username" class="formulario__label">Usuario *</label>
                <div class="formulario__grupo-input">
                    <input type="text" class="formulario__input" name="username" id="username" >
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>

                <p class="formulario__input-error">El usuario no cumple los requisitos</p>
            </div>

            <br>

            <!-- Grupo: Password -->
            <div class="formulario__grupo" id="grupo__password">
                <label for="password" class="formulario__label">Contraseña *</label>
                <div class="formulario__grupo-input">
                    <input type="password" class="formulario__input" name="password" id="password" >
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>

                <p class="formulario__input-error">La contraseña ingresada no cumple los requisitos</p>
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

</body>
</html>