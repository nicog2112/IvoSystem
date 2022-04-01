<?php

require_once "../../class/Talle.php";
require_once "../../class/Producto.php";
require_once "../../class/ProductoTalle.php";

$idProducto = $_GET["id"];

$lista = ProductoTalle::obtenerPorIdProducto($idProducto);

$listadoTalle = Talle::obtenerTodosActivos();

?>


<form method="POST" action="procesar_alta.php" class="form__reg" name="formularioNuevo" id="formularioNuevo">


	<input type="hidden" name="txtIdProducto" value="<?php echo $idProducto; ?>">



	<div class="formulario__grupo" id="grupo__cantidadMaximaNuevo" >
		<label for="cantidadMaximaNuevo" class="formulario__label">Cantidad Maxima:</label>
		<div class="formulario__grupo-input">
			<input type="number" name="cantidadMaximaNuevo" id="cantidadMaximaNuevo" class="formulario__input"><i class="formulario__validacion-estado fas fa-times-circle"></i>
		</div>
		<p class="formulario__input-error">La cantidad tiene que ser de 1 a 5 dígitos </p>

	</div>

	<div class="formulario__grupo" id="grupo__cantidadMinimaNuevo" >
		<label for="cantidadMinimaNuevo" class="formulario__label">Cantidad Minima:</label>
		<div class="formulario__grupo-input">
			<input type="number" name="cantidadMinimaNuevo" id="cantidadMinimaNuevo" class="formulario__input"><i class="formulario__validacion-estado fas fa-times-circle"></i>
		</div>
		<p class="formulario__input-error">La cantidad tiene que ser de 1 a 5 dígitos </p>

	</div>

	<div class="formulario__grupo" id="grupo__cantidadDisponibleNuevo" >
		<label for="cantidadDisponibleNuevo" class="formulario__label">Cantidad Disponible:</label>
		<div class="formulario__grupo-input">
			<input type="number" name="cantidadDisponibleNuevo" id="cantidadDisponibleNuevo" class="formulario__input"><i class="formulario__validacion-estado fas fa-times-circle"></i>
		</div>
		<p class="formulario__input-error">La cantidad tiene que ser de 1 a 5 dígitos </p>

	</div>



	<!-- Grupo: Sexo -->
	<div class="formulario__grupo" id="grupo__talleNuevo">
		<label for="talleNuevo" class="formulario__label">Talle</label>
		<div class="formulario__grupo-input">
			<select name="talleNuevo" id="talleNuevo" class="formulario__input" required>
				<option value="">---Seleccionar---</option>

				<?php foreach ($listadoTalle as $talle): ?>
					<?php 
					$TalleId= $talle->getIdTalle(); 
					$listadoTalleProducto=ProductoTalle::obtenerPorIdProductoYTalles($idProducto,$TalleId);

					$cantidadProductoTalle= count($listadoTalleProducto);
					if ($cantidadProductoTalle < 1){
						?>
						<option value="<?php echo $talle->getIdTalle(); ?>">
							<?php echo $talle->getDescripcion(); ?>
						</option>
					<?php } ?>
				<?php endforeach ?>

			</select>
			<i class="formulario__validacion-estado fas fa-times-circle"></i>
		</div>
		<br>
		<p class="formulario__input-error">El talle no puede estar vacio. Seleccione una opcion</p>
	</div>

	<div class="formulario__mensaje" id="formulario__mensaje">
		<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
	</div>
	<br>
	<div class="formulario__grupo formulario__grupo-btn-enviar">

		<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
		<br>
	</div>
	<button type="cancel" name="Cancelar" class="botonCancelar"  onclick="window.location='/programacion_3/boutique/modulos/productoTalle/listado.php?id_producto=<?php echo $idProducto; ?>';return false;">Cancelar</button>

	<input type="submit" name="Guardar" value="Guardar"  class="botonGuardar">
	<br><br>

</form>

