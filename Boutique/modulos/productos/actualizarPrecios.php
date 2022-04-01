<?php


require_once "../../class/Temporada.php";
require_once "../../class/Categoria.php";

$listadoCategoria = Categoria::obtenerTodos();

$listadoTemporada = Temporada::obtenerTodos();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" href="../../css/formularioNUEVO.css">
	
	<link rel="shortcut icon" href="/programacion_3/boutique/logo.ico">

	<script src="/programacion_3/boutique/jquery/jquery-3.3.1.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#cboMetodo').change(function(e) {
				if ($(this).val() === "1" ) {
					$('#categoria').prop("hidden", false);
				} else {
					$('#categoria').prop("hidden", true);
				}
				if ($(this).val() === "2" ) {
					$('#temporada').prop("hidden", false);
				} else {
					$('#temporada').prop("hidden", true);
				}
				if ($(this).val() === "3" ) {
					$('#marca').prop("hidden", false);
				} else {
					$('#marca').prop("hidden", true);
				}

			})
			$('#cboMetodoActualizar').change(function(e) {
				if ($(this).val() === "1" ) {
					$('#porcentaje').prop("hidden", false);
				} else {
					$('#porcentaje').prop("hidden", true);
				}
				if ($(this).val() === "2" ) {
					$('#valorFijo').prop("hidden", false);
				} else {
					$('#valorFijo').prop("hidden", true);
				}
			

			})
		});


	</script>
	<title>Formulario</title>
	<style>
	.error{
		background-color: #FF9185;
		font-size: 12px;
		padding: 10px;
	}
	.correcto{
		background-color: #A0DEA7;
		font-size: 12px;
		padding: 10px;
	}
</style>
</head>
<body>
	
	<br>

	<?php require_once "../../menu.php"; ?>
	<div class="container">
		<div class="form__top">
			<h2>Formulario Actualizacion de <span>Precios de Venta</span></h2>
		</div>	

		<br><br>
		<center>
			<form method="POST" action="procesarActualizarPrecioPorcentaje.php" enctype="multipart/form-data" class="form__reg">
				<div>

					<div class="formulario__grupo" id="grupo__" >
						<label for="cboMetodo" class="formulario__label">Seleccione que Metodo desea usar para actualizar los precios:</label>
						<div class="formulario__grupo-input">
							<select name="cboMetodo" id='cboMetodo' class="formulario__input" >
								<option value="NULL">---Seleccionar---</option>

								<option value="1">Actualizar por Categorias</option>
								<option value="2">Actualizar por Temporada</option>
								<option value="3">Actualizar por Marca </option>

							</select>

						</div>
						<br>
						<p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

					</div>
				</div>



				<div id="categoria" hidden="hidden">

					<div class="formulario__grupo" id="grupo__" >
						<label for="cboMetodo" class="formulario__label">Seleccione la categoria:</label>
						<div class="formulario__grupo-input">
							<select name="categoria"  class="formulario__input">
								<option value="NULL">---Seleccionar---</option>

								<?php foreach ($listadoCategoria as $categoria): ?>

									<option value="<?php echo $categoria->getIdCategoria(); ?>">
										<?php echo $categoria->getNombre(); ?>
									</option>

								<?php endforeach ?>
							</select>
						</div>
						<br>
						<p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

					</div>
				</div>



				<div id="temporada" hidden="hidden">

					<div class="formulario__grupo" id="grupo__" >
						<label for="cboMetodo" class="formulario__label">Seleccione la temporada:</label>
						<div class="formulario__grupo-input">
							<select name="temporada"  class="formulario__input">
								<option value="NULL">---Seleccionar---</option>

								<?php foreach ($listadoTemporada as $temporada): ?>

									<option value="<?php echo $temporada->getIdTemporada(); ?>">
										<?php echo $temporada->getNombre(); ?>
									</option>

								<?php endforeach ?>
							</select>

						</div>
						<br>
						<p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

					</div>
				</div>


				<div id="marca" hidden="hidden">
					<div class="formulario__grupo" id="grupo__cuit" >
						<label for="cuit" class="formulario__label">Escriba la Marca:</label>
						<div class="formulario__grupo-input">
							<input name="marca"  type="text"  class="formulario__input" placeholder="Marca">
						</div>
						<br>
						<p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

					</div>
				</div>




				<div>

					<div class="formulario__grupo" id="grupo__" >
						<label for="cboMetodoActualizar" class="formulario__label">Seleccione como desea actualizar los precios:</label>
						<div class="formulario__grupo-input">
							<select name="cboMetodoActualizar" id='cboMetodoActualizar' class="formulario__input" >
								<option value="NULL">---Seleccionar---</option>

								<option value="1">Actualizar por Porcentace</option>
								<option value="2">Actualizar por Valor Fijo</option>


							</select>

						</div>
						<br>
						<p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

					</div>
				</div>










				<div id="porcentaje" hidden="hidden">
					<div class="formulario__grupo" id="grupo__cuit" >
						<label for="cuit" class="formulario__label">Escriba el porcentaje:</label>
						<div class="formulario__grupo-input">
							<input type="number" name="porcentaje" class="formulario__input">
						</div>
						<br>
						<p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

					</div>
				</div>

				<div id="valorFijo" hidden="hidden">
					<div class="formulario__grupo" id="grupo__cuit" >
						<label for="cuit" class="formulario__label">Escriba el valor Fijo:</label>
						<div class="formulario__grupo-input">
							<input type="number" name="valorFijo" class="formulario__input">
						</div>
						<br>
						<p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

					</div>
				</div>


				<div id="accion">
					<div class="formulario__grupo" id="grupo__cuit" >
						<label for="cuit" class="formulario__label">Accion a realizar</label>
						<div class="formulario__grupo-input">
							<input type = "radio" name = "accion" value = "1" /> Aumentar
							<input type = "radio" name = "accion" value = "2" /> Disminuir
						</div>
						<br>
						<p class="formulario__input-error">El nombre del Proveedor tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>

					</div>
				</div>



				<input type="submit" name="Guardar" class="btn__submit" >


			</form>
		</center>

	</body>
	
	</html>