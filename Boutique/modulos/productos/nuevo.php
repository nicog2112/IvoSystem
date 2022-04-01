
<?php

require_once "../../class/Temporada.php";
require_once "../../class/Categoria.php";

$listadoCategoria = Categoria::obtenerTodosActivos();

$listadoTemporada = Temporada::obtenerTodosActivos();

?>

	<form method="POST" action="procesar_alta.php" enctype="multipart/form-data" class="form__reg" name="formularioNuevo" id="formularioNuevo">

		
		<div id ="columnaModulos">
					<!-- Grupo: Imagen -->
        <div class="formulario__grupo" id="grupo__imagenProductoNuevo">
            <label for="imagenProductoNuevo" class="formulario__label">Imagen *</label>
            <div class="formulario__grupo-input">
                <input type="file" class="formulario__input" id="imagenProductoNuevo" name="imagenProductoNuevo" accept="image/*">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>

            <p class="formulario__input-error">La imagen tiene que ser jpg ,png</p>
        </div>
		
		<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombreProductoNuevo">
				<label for="nombreProductoNuevo" class="formulario__label">Nombre *</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombreProductoNuevo" id="nombreProductoNuevo" placeholder="Nombre">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
		
				<p class="formulario__input-error"></p>
			</div>

	
		<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__marcaProductoNuevo">
				<label for="marcaProductoNuevo" class="formulario__label">Marca *</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="marcaProductoNuevo" id="marcaProductoNuevo" placeholder="Marca">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
	
				<p class="formulario__input-error"></p>
			</div>

		<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__descripcionProductoNuevo">
				<label for="descripcionProductoNuevo" class="formulario__label">Descripcion *</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="descripcionProductoNuevo" id="descripcionProductoNuevo" placeholder="Descripcion">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>

				<p class="formulario__input-error"></p>
			</div>

				<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__precioCompraNuevo">
				<label for="precioCompraNuevo" class="formulario__label">Precio de compra *</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="precioCompraNuevo" id="precioCompraNuevo" placeholder="140">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
			
				<p class="formulario__input-error"></p>
			</div>


			<div class="formulario__grupo" id="grupo__precioVentaNuevo">
				<label for="precioVentaNuevo" class="formulario__label">Precio de Venta *</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="precioVentaNuevo" id="precioVentaNuevo" placeholder="140">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error"></p>
			</div>


			<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__temporadaNuevo">
				<label for="temporadaNuevo" class="formulario__label">TEMPORADA *</label>
				<div class="formulario__grupo-input">
					<select required name="temporadaNuevo" class="formulario__input" id="temporadaNuevo">
						    <option value="">---Seleccionar---</option>

						    <?php foreach ($listadoTemporada as $temporada): ?>

						    	<option value="<?php echo $temporada->getIdTemporada(); ?>">
						    		<?php echo $temporada->getNombre(); ?>
						    	</option>

						    <?php endforeach ?>
		 			</select>
					
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error"></p>
			</div>

				<div class="formulario__grupo" id="grupo__nombreCategoria">
				<label for="nombreCategoria" class="formulario__label" >CATEGORIA *</label>
				<div class="formulario__grupo-input">
					<select required name="nombreCategoria" class="formulario__input" id="nombreCategoria">
						      <option value="">---Seleccionar---</option>

						    <?php foreach ($listadoCategoria as $categoria): ?>

						    	<option value="<?php echo $categoria->getIdCategoria(); ?>">
						    		<?php echo $categoria->getNombre(); ?>
						    	</option>

						    <?php endforeach ?>
		 			</select>
					
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<br>
				<p class="formulario__input-error"></p>
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

