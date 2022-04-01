
<?php 

require_once "../../class/Talle.php";
require_once "../../class/Cliente.php";
require_once "../../class/Empleado.php";
require_once "agregarAlCarrito.php";
require_once "../../class/ProductoTalle.php";
require_once "../../class/TipoFactura.php";
require_once "../../class/EstadosPago.php";
require_once "../../class/TipoPago.php";
require_once "../../class/TiposImpositivos.php";

$listadoTiposImpositivos = TiposImpositivos::obtenerPorEstado();

$listadoTalle = Talle::obtenerTodos();
$listadoClientes = Cliente::obtenerTodos();
$listadoEmpleados = Empleado::obtenerTodos();
$listadoTipoFactura = TipoFactura::obtenerTodos();
$listadoEstadosPagos = EstadosPagos::obtenerTodos();
$listadoTipoPago = TipoPago::obtenerTodos();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" href="../../css/formularioNUEVO.css">
	
	
	<link rel="stylesheet" href="../../css/tablaNUEVO.css">
	<link rel="stylesheet" href="../../css/all.min.css">
	<link rel="stylesheet" href="../../css/botonesNUEVO.css">
	<link rel="shortcut icon" href="/programacion_3/boutique/logo.ico">
	<link rel="stylesheet" href="../../css/modalNUEVO.css">	
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
	#cajon1{
		float:left;
		border-spacing: 5px;
		border-collapse: collapse;
		border-radius: 15px;
		overflow: hidden;
		text-align: center; 
		margin: 0px 60px   ;
		font-size: 0.7em;
		font-family: sans-serif;
		width: 45%;
		height: 300px;
		min-width: 200px;
		box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.15);
		;
	}
	#cajon1 h1{
		background-color: #400098; 
		color: #ffffff;
		text-align: center;
		padding: 12px 15px;}

		#cajon2{
			
			border-spacing: 5px;
			border-collapse: collapse;
			border-radius: 15px;
			overflow: hidden;
			text-align: center; 
			font-size: 0.7em;
			font-family: sans-serif;
			width: 40%;
			height: 300px;
			min-width: 400px;
			box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.15);

			;
		}

		#cajon2 h1{
			background-color: #400098; 
			color: #ffffff;
			text-align: center;
			padding: 12px 15px;}
			/*Ahora, para diferenciarlo, vamos a colocarle colores a cada cajón:*/
			#cajon1{
				float:left;
				background-color: #E4E9F7;
			}
			#cajon2{
				float: center;


				background-color: #B2BCDA;
			}
		</style>
		<script src="../../js/ventanaModal.js"></script>
		
	</head>
	<body>

		<?php require_once "../../menu.php"; ?>
		<?php 
		if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
		$granTotal = 0;

		?>
		<section class="home-section">

			<h1 style="color:#FFFFFF;">Vender</h1>
			
			
			<?php
			if(isset($_GET["status"])){
				if($_GET["status"] === "1"){
					?>
					<div class="alert alert-success">
						<strong>¡Correcto!</strong> Venta realizada correctamente
					</div>
					<?php
				}else if($_GET["status"] === "2"){
					?>
					<div class="alert alert-info">
						<strong>Venta cancelada</strong>
					</div>
					<?php
				}else if($_GET["status"] === "3"){
					?>
					<div class="alert alert-info">
						<strong>Ok</strong> Producto quitado de la lista
					</div>
					<?php
				}else if($_GET["status"] === "4"){
					?>
					<div class="alert alert-warning">
						<strong>Error:</strong> El producto que buscas no existe
					</div>
					<?php
				}else if($_GET["status"] === "5"){
					?>
					<div class="alert alert-danger">
						<strong>Error: </strong>El producto está agotado
					</div>
					<?php
				}else{
					?>
					<div class="alert alert-danger">
						<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
					</div>
					<?php
				}
			}
			?>
			
			<div id=cajon1>
				<h1>Añadir Producto al carrito</h1>
				<form method="post" action="agregarAlCarrito.php" >
					
					<input type="hidden" name="promocion" value="0">
					<input type="hidden" name="estado" value="1">

					<div class="formulario__grupo" id="grupo__codigo" >
						<label for="idProducto" class="formulario__label">Código del producto:</label>
						<div class="formulario__grupo-input">
							<input type="text" class="formulario__input" name="idProducto" id="idProducto" placeholder="Escribe el código">
							<i class="formulario__validacion-estado fas fa-times-circle"></i>
						</div>	
						<br>
						<p class="formulario__input-error">Error</p>
					</div>



					<div class="formulario__grupo" id="grupo__cantidad" >
						<label for="cantidad" class="formulario__label">Cantidad:</label>
						<div class="formulario__grupo-input">
							<input type="number" class="formulario__input" name="cantidad" id="cantidad" placeholder="Escribe el código">
							<i class="formulario__validacion-estado fas fa-times-circle"></i>
						</div>	
						<br>
						<p class="formulario__input-error">Error</p>
					</div>

					<div class="formulario__grupo" id="grupo__cantidad" >
						<label for="cboTalle" class="formulario__label">Talle:</label>
						<div class="formulario__grupo-input">
							<select class="formulario__input" name="cboTalle" id="cboTalle">
								<option value="NULL">---Seleccionar---</option>

								<?php foreach ($listadoTalle as $talle): ?>

									<option value="<?php echo $talle->getIdTalle(); ?>">
										<?php echo $talle->getDescripcion(); ?>
									</option>

								<?php endforeach ?>

								
								
								<i class="formulario__validacion-estado fas fa-times-circle"></i>
							</select>
						</div>	
						<br>
						<p class="formulario__input-error">Error</p>
					</div>

					
					<input type="submit" name="Cargar" class="btn__submit">
				</div>
			</form>
		</div>
		<div id=cajon2>
			<h1>Datos del Vendedor</h1>
			<form action="#" method="POST">
				<label for="nombreUsuario" class="formulario__label">Nombre Completo:</label>
				<input type="text" class="formulario__input" name="nombreUsuario" id="nombreUsuario" value="<?php echo $usuario; ?>"  disabled>
				<label for="username" class="formulario__label">Usuario:</label>
				<input type="text" class="formulario__input" name="username" id="username" value="<?php echo $usuario->getUsername();?>"  disabled>
				<label for="dni" class="formulario__label">DNI:</label>
				<input type="text" class="formulario__input" name="dni" id="dni" value="<?php echo $usuario->getDNI();?>"  disabled>
				<label for="dni" class="formulario__label">Perfil:</label>
				<input type="text" class="formulario__input" name="dni" id="dni" value="<?php echo $usuario->perfil->getDescripcion();?>"  disabled>
			</form>
		</div>
		<br>
		
		
		<table class="styled-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Código</th>
					<th>Imagen</th>
					<th>Descripción</th>
					<th>Talle</th>
					<th>Precio de venta</th>
					<th>Descuento x Promocion</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th>Quitar</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach($_SESSION["carrito"] as $indice => $producto){ 
					$granTotal += $producto->subtotal;
					?>
					<tr class="active-row">
						<td><?php echo $producto->getIdProductoTalle() ?></td>
						<td><?php echo $producto->getIdProducto() ?></td>
						<td><img src='../../modulos/productos/<?php echo $producto->producto->getImagen() ?>'style="max-width:100px;width:70px;height:100px;"></td>
						<td><?php echo $producto->producto->getDescripcion() ?></td>
						<td>
							<?php 
							$id_talle=$producto->getIdTalle();
							foreach ($listadoTalle as $talle): 

								if ($talle->getIdTalle() == $id_talle) {
									echo $talle->getDescripcion();;
								}
							endforeach
							?>
							
						</td>
						<td><?php echo $producto->producto->getPrecioVenta() ?></td>
						<td><?php echo 0 ?></td>
						<td><?php echo $producto->cantidad ?></td>
						<td><?php echo $producto->subtotal ?></td>
						<td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>"><i class="botonEliminar fas fa-trash"></i></a></td>
					</tr>
				<?php } ?>
					<tr>
						<td><td colspan="7"><h3 style="text-align: right;" >SubTotal: </h3></td></td>
						<td><?php echo $granTotal; ?></td>
					</tr>
					<?php $totalSumaImpuestos = 0; //obtener valor impuestos

    					foreach ($listadoTiposImpositivos as $tiposImpositivos):
       					$nombreImpuesto= $tiposImpositivos->getDescripcion();
       					$valorPorcentajeImpuesto= $tiposImpositivos->getValorPorcentaje();
       					$totalImpuesto= $granTotal * $valorPorcentajeImpuesto / 100;
       					$totalSumaImpuestos= $totalSumaImpuestos + $totalImpuesto; ?>
        					
      
    				
					<tr>
						<td><td colspan="7"><h3 style="text-align: right;" ><?php echo $nombreImpuesto; echo " ";echo $valorPorcentajeImpuesto;  ?>% </h3></td></td>
						<td><?php echo $totalImpuesto; ?></td>
					</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="8"><h3 style="text-align: right;" >Total </h3></td></td>
						<td><?php $totalFinal= $totalSumaImpuestos + $granTotal;
						 echo $totalFinal; ?></td>
					</tr>
			</tbody>
			
		</table>
	</div>
	<br><br>
	<div id="containerNuevo">
	<a href="#" id="abrir" class="botonAñadir" onclick="abrirModal(this.id);">Realizar Venta</a>
	<a href="./cancelarVenta.php" >Cancelar venta</a>
</div>


	<br><br>
	<div id="miModal" class="modal">
		<div class="flex" id="flex">
			<div class="contenido-modal">
				<div class="modal-header flex">
					<h2>Realizar Venta</h2>
					<span class="close" id="close">&times;</span>
				</div>
				<div class="modal-body">
					<form action="./terminarVenta.php" method="POST" id="formulario">
						
						<input name="total" type="hidden" value="<?php echo $granTotal;?>">
						<input name="estado" type="hidden" value="1">
						





						<!-- Grupo: Cliente -->
						<div class="formulario__grupo" id="grupo__cliente">
							<label for="cliente" class="formulario__label">Cliente</label>
							<div class="formulario__grupo-input">
								<select name="cliente" id="cliente" class="formulario__input" onclick="validarCliente();">
									<option value="NULL">---Seleccionar---</option>

									<?php foreach ($listadoClientes as $cliente): ?>

										
										<option value="<?php echo $cliente->getIdCliente(); ?>">
											<?php echo $cliente->getNombre(); echo " ";
											echo $cliente->getApellido();?>
										</option>
									<?php endforeach ?>

								</select>
								<i class="formulario__validacion-estado fas fa-times-circle"></i>
							</div>
							<br>
							<p class="formulario__input-error">El cliente no puede estar vacio. Seleccione una opcion</p>
						</div>







						
						
						<?php $idPersona = $usuario->getIdPersona(); 
						$empleado = Empleado::obtenerPorIdPersona($idPersona);?>
						
						<input type="text" class="formulario__input" hidden="hidden" name="Empleado" id="Empleado" value="<?php echo $empleado->getIdEmpleado(); ?>" >



						<!-- Grupo: TipoFactura -->
						<div class="formulario__grupo" id="grupo__TipoFactura">
							<label for="tipoFactura" class="formulario__label">Tipo de Factura</label>
							<div class="formulario__grupo-input">
								<select name="tipoFactura" id="tipoFactura" class="formulario__input" onclick="validarCliente();">
									<option value="NULL">---Seleccionar---</option>

									<?php foreach ($listadoTipoFactura as $tipoFactura): ?>

										
										<option value="<?php echo $tipoFactura->getIdTipoFactura(); ?>">
											<?php echo $tipoFactura->getDescripcion();?>
										</option>
									<?php endforeach ?>

								</select>
								<i class="formulario__validacion-estado fas fa-times-circle"></i>
							</div>
							<br>
							<p class="formulario__input-error">El TIPO FACTURA no puede estar vacio. Seleccione una opcion</p>
						</div>


						<!-- Grupo: EstadosPagos -->
						<div class="formulario__grupo" id="grupo__estadosPagos" hidden="hidden">
							<label for="estadosPagos" class="formulario__label">Estado del Pago</label>
							<div class="formulario__grupo-input">
								<select name="estadosPagos" id="estadosPagos" class="formulario__input" onclick="validarCliente();">
									

									<?php foreach ($listadoEstadosPagos as $estadosPagos): ?>

										
										<option value="<?php echo $estadosPagos->getIdEstadosPagos(); ?>">
											<?php echo $estadosPagos->getDescripcion();?>
										</option>
									<?php endforeach ?>

								</select>
								<i class="formulario__validacion-estado fas fa-times-circle"></i>
							</div>
							<br>
							<p class="formulario__input-error">El TIPO FACTURA no puede estar vacio. Seleccione una opcion</p>
						</div>


						<!-- Grupo: TipoPago -->
						<div class="formulario__grupo" id="grupo__TipoPago">
							<label for="tipoPago" class="formulario__label">Tipo de Pago</label>
							<div class="formulario__grupo-input">
								<select name="tipoPago" id="tipoPago" class="formulario__input" onclick="validarCliente();">
									<option value="NULL">---Seleccionar---</option>

									<?php foreach ($listadoTipoPago as $tipoPago): ?>

										
										<option value="<?php echo $tipoPago->getIdTipoPago(); ?>">
											<?php echo $tipoPago->getDescripcion();?>
										</option>
									<?php endforeach ?>

								</select>
								<i class="formulario__validacion-estado fas fa-times-circle"></i>
							</div>
							<br>
							<p class="formulario__input-error">El TIPO PAGO no puede estar vacio. Seleccione una opcion</p>
						</div>

						<label for="numeracion" class="formulario__label">Numeracion:</label>
						<input type="text" class="formulario__input" name="numeracion" id="numeracion"  >




						<input type="hidden" name="promocion" value="1">
						<br><br>
						<button type="submit" class="botonGuardar">Terminar venta</button>
						<a href="./cancelarVenta.php" class="botonCancelar">Cancelar venta</a>
						
						<br><br>
					</form>
					
				</div>
				
			</div>
		</div>
	</div>
	
</section>
</body>

</html>


