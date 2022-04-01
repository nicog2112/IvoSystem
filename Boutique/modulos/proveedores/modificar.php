<?php

require_once "../../class/Proveedor.php";


$id_proveedor = $_GET['id'];

$proveedor = Proveedor::obtenerPorId($id_proveedor);


?>


<form method="POST" action="procesar_modificacion.php" class="form__reg" name="formulario" id="formulario">

	<input type="hidden" name="txtIdProveedor" id="id" value="<?php echo $id_proveedor; ?>"> 

	<div class="formulario__grupo" id="grupo__nombre" >
		<label for="nombre" class="formulario__label">Nombre del Proveedor *</label>
		<div class="formulario__grupo-input">
			<input type="text" class="formulario__input" name="nombre" id="nombre" value="<?php echo $proveedor->getNombreProveedor();?>" >
			<i class="formulario__validacion-estado fas fa-times-circle"></i>
		</div>	
		<p class="formulario__input-error">El nombre del Proveedor solo puede contener letras, se debe escribir minimo 3 caracteres, los espacios estan permitidos unicamente en el medio y no puede estar vacio.</p>
	</div>
	<br>	
	<div class="formulario__grupo" id="grupo__cuit" >
		<label for="cuit" class="formulario__label">CUIT *</label>
		<div class="formulario__grupo-input">
			<input type="number" name="cuit" id="cuit" class="formulario__input" value="<?php echo $proveedor->getCuit();?>"><i class="formulario__validacion-estado fas fa-times-circle"></i>
		</div>
		<p class="formulario__input-error">El CUIT del Proveedor tiene que ser de 8 a 11 dígitos y solo puede contener numeros</p>

	</div>

	<br>

	<div class="formulario__mensaje" id="formulario__mensaje">
		<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
	</div>
	<br>
	<div class="formulario__grupo formulario__grupo-btn-enviar">

		<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
		<br>
	</div>
	<button type="cancel" name="Cancelar" class="botonCancelar"  onclick="window.location='/programacion_3/boutique/modulos/proveedores/listado.php';return false;">Cancelar</button>

	<input type="submit" name="Guardar" value="Actualizar"  class="botonGuardar">
	<br><br>
</form>

