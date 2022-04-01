<?php

require_once "../../class/Producto.php";
require_once "../../class/Temporada.php";
require_once "../../class/Categoria.php";

$listadoCategoria = Categoria::obtenerTodosActivos();

$listadoTemporada = Temporada::obtenerTodosActivos();


$id_producto = $_GET["id"];

$producto = Producto::obtenerPorId($id_producto);


?>



<form method="POST" action="procesar_modificacion.php" enctype="multipart/form-data"  class="form__reg" name="formularioModificar" id="formularioModificar">


	<input type="hidden" name="txtIdProducto" value="<?php echo $id_producto; ?>">

	<div id ="columnaModulos">
		<!-- Grupo: Imagen -->
		<div class="formulario__grupo" id="grupo__imagenModificar">
			<label for="imagenModificar" class="formulario__label">Imagen</label>
			<div class="formulario__grupo-input">
				<input type="file" class="formulario__input" id="imagenModificar" name="imagenModificar" accept="image/*" value="<?php echo $producto->getImagen(); ?>">
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>

			<p class="formulario__input-error">La imagen tiene que ser jpg ,png</p>
		</div>
		
		<!-- Grupo: Nombre -->
		<div class="formulario__grupo" id="grupo__nombreProductoModificar">
			<label for="nombreProductoModificar" class="formulario__label">Nombre *</label>
			<div class="formulario__grupo-input">
				<input type="text" class="formulario__input" name="nombreProductoModificar" id="nombreProductoModificar" placeholder="Nombre" value="<?php echo $producto->getNombreProducto(); ?>">
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
			
			<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
		</div>

		
		<!-- Grupo: Nombre -->
		<div class="formulario__grupo" id="grupo__marcaProductoModificar">
			<label for="marcaProductoModificar" class="formulario__label">Marca *</label>
			<div class="formulario__grupo-input">
				<input type="text" class="formulario__input" name="marcaProductoModificar" id="marcaProductoModificar" placeholder="Marca" value="<?php echo $producto->getMarca(); ?>">
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
			
			<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
		</div>

		<!-- Grupo: Nombre -->
		<div class="formulario__grupo" id="grupo__descripcionProductoModificar">
			<label for="descripcionProductoModificar" class="formulario__label">Descripcion *</label>
			<div class="formulario__grupo-input">
				<input type="text" class="formulario__input" name="descripcionProductoModificar" id="descripcionProductoModificar" placeholder="Descripcion" value="<?php echo $producto->getDescripcion(); ?>">
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>

			<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
		</div>

		<!-- Grupo: Nombre -->
		<div class="formulario__grupo" id="grupo__precioCompraModificar">
			<label for="precioCompraModificar" class="formulario__label">Precio de compra *</label>
			<div class="formulario__grupo-input">
				<input type="text" class="formulario__input" name="precioCompraModificar" id="precioCompraModificar" placeholder="140" value="<?php echo $producto->getPrecioCompra(); ?>">
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
			
			<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
		</div>


		<div class="formulario__grupo" id="grupo__precioVentaModificar">
			<label for="precioVentaModificar" class="formulario__label">Precio de Venta *</label>
			<div class="formulario__grupo-input">
				<input type="text" class="formulario__input" name="precioVentaModificar" id="precioVentaModificar" placeholder="140" value="<?php echo $producto->getPrecioVenta(); ?>" >
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
			<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
		</div>


		<!-- Grupo: Nombre -->
		<div class="formulario__grupo" id="grupo__nombreTemporadaModificar">
			<label for="nombreTemporadaModificar" class="formulario__label">TEMPORADA *</label>
			<div class="formulario__grupo-input">
				<select name="nombreTemporadaModificar" class="formulario__input" id="nombreTemporadaModificar">
					<option value="NULL">---Seleccionar---</option>

					<?php foreach ($listadoTemporada as $temporada): ?>
						<?php

						$selected = "";

						if ($temporada->getIdTemporada() == $producto->getIdTemporada()) {
							$selected = "SELECTED";
						}

						?>
						<option <?php echo $selected; ?> value="<?php echo $temporada->getIdTemporada(); ?>">
							<?php echo $temporada->getNombre(); ?>
						</option>

					<?php endforeach ?>
				</select>
				
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
			<br>
			<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
		</div>

		<div class="formulario__grupo" id="grupo__nombreCategoriaModificar">
			<label for="nombreCategoriaModificar" class="formulario__label">CATEGORIA *</label>
			<div class="formulario__grupo-input">
				<select name="nombreCategoriaModificar" class="formulario__input" id="nombreCategoriaModificar">
					<option value="NULL">---Seleccionar---</option>

					<?php foreach ($listadoCategoria as $categoria): ?>
						<?php

						$selected = "";

						if ($categoria->getIdCategoria() == $producto->getIdCategoria()) {
							$selected = "SELECTED";
						}

						?>
						<option <?php echo $selected; ?> value="<?php echo $categoria->getIdCategoria(); ?>">
							<?php echo $categoria->getNombre(); ?>
						</option>

					<?php endforeach ?>
				</select>
				
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
			<br>
			<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
		</div>

		

		
	</div>

		<div class="formulario__mensaje" id="formulario__mensaje">
			<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
		</div>
		<br>
		<div class="formulario__grupo formulario__grupo-btn-enviar">
			
			<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Registro Insertado Exitosamente!</p>
			<br>
		</div>
	<br>
	<button type="cancel" name="Cancelar" class="botonCancelar"  onclick="window.location='/programacion_3/boutique/modulos/productos/listado.php';return false;">Cancelar</button>
	
	<input type="submit" name="Guardar" value="Guardar"  class="botonGuardar">
	<br><br>
	















</form>
