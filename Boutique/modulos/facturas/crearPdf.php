<?php ob_start();

require_once "../../class/DetalleFactura.php";
require_once "../../class/Venta.php";
require_once "../../class/FacturaImpuestos.php";
require_once "../../class/Empleado.php";
require_once "../../class/TipoFactura.php";



$id_venta= $_GET["id_pedido_cliente"];
$lista = Venta::obtenerPorIdVenta($id_venta);
$listaDetallesFactura = DetalleFactura::obtenerPorIdVenta($id_venta);

// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;


// Introducimos HTML de prueba

?>

 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Factura</title>
    <link rel="stylesheet" href="style.css">
</head>
<!-- <img class="anulada" src="img/anulado.png" alt="Anulada"> --> 
<body>
<?php foreach($lista as $venta){ 
	$estadoVenta= $venta->estado->getIdEstadoPedido();
	if ($estadoVenta == 2){
	
			echo "<img class='anulada' src='img/anulado.png' alt='Anulada'>";} 

 } ?>

<div id="page_pdf">
	<table id="factura_head">
		<tr>
			<td class="logo_factura">
				<div>
					<img src="img/logo2.png" style="width: 100px;">
				</div>
			</td>
			<td class="info_empresa">
				<div>
					<span class="h2">IVO SYSTEM</span>
					<p>Argentina, Formosa, Formosa </p>
					<p>Teléfono: +(54) 444-3333</p>
					<p>Email: info@ivosystem.com</p>
				</div>
			</td>
			<td class="info_factura">
				<div class="round">
					<?php $x = 1; foreach($listaDetallesFactura as $detalleFactura){	
						$idTipoFactura= $detalleFactura->factura->getIdTipoFactura();
						$tipoFactura= TipoFactura::obtenerPorId($idTipoFactura);

						?>
						<?php if($x === 1){ ?>
					<span class="h3">Factura <?php echo $tipoFactura->getDescripcion(); ?></span>

				
						
       

					<p>No. Factura: <strong><?PHP echo $detalleFactura->factura->getNumeracion(); ?></strong></p>
					<p>Fecha: <?PHP echo $detalleFactura->factura->getFechaEmision(); ?></p>
					
					<p>Vendedor: <?PHP 
						$idEmpleado = $detalleFactura->detalleVenta->pedidoCliente->getIdEmpleado();
						if (empty($idEmpleado)){

						echo "Pagina Web";
					} else {
						 $empleado= Empleado::obtenerPorId($idEmpleado);
                        echo $empleado->getNombre();
                        echo " ";
                        echo $empleado->getApellido();
                    
					}
					// echo $detalleFactura->detalleVenta->pedidoCliente->empleado->getNombre(); echo " ";echo $detalleFactura->detalleVenta->pedidoCliente->empleado->getApellido();
					//$empleado= Empleado::obtenerPorId($detalleFactura->detalleVenta->pedidoCliente->getIdEmpleado()); 
					//echo $empleado->getNombre();?> </p>
					<?php } $x++; } ?>
				</div>
			</td>
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3">Cliente</span>
					<table class="datos_cliente">
						<?php foreach($lista as $venta){ ?>
						<tr>
							<td><label><u><b>Apellido:</b></u></label><p><?php echo $venta->cliente->getApellido(); ?></p></td>
							<td><label><u><b>Nombre:</b></u></label> <p><?php echo $venta->cliente->getNombre(); ?></p></td>
							<td><label><u><b>DNI:</b></u></label> <p><?php echo $venta->cliente->getDni(); ?></p></td>
							
						</tr>
						<?php } ?>
					</table>
				</div>
			</td>

		</tr>
	</table>

	<table id="factura_detalle">
			<thead>
				<tr>
					<th width="50px">Cant.</th>
					<th class="textleft">Descripción</th>
					<th class="textright" width="150px">Precio Unitario.</th>
					<th class="textright" width="150px"> Precio Total</th>
				</tr>
			</thead>
			<tbody id="detalle_productos">
				<?php $precioFinal = 0; ?>
				<?php foreach($lista as $venta){ ?>
				<?php foreach($listaDetallesFactura as $detalleFactura){ ?>
				<tr>
					<td class="textcenter"><?php echo $detalleFactura->detalleVenta->getCantidad(); ?></td>
					<td><?php echo $detalleFactura->detalleVenta->productoTalle->producto->getDescripcion(); ?></td>
					<td class="textright">$<?php echo $detalleFactura->detalleVenta->getPrecio(); ?></td>
					 <?php 

                                        $precio_total="";
                                        $cantidad=  $detalleFactura->detalleVenta->getCantidad();
                                        $precio_venta= $detalleFactura->detalleVenta->getPrecio();

                                        $precioTotal= $precio_venta * $cantidad;

                                        ?>
                                        <td class="textright">$<?php echo $precioTotal; ?></td>
                                       <?php
                                        
                            
                                       $precioFinal = $precioFinal + $precioTotal; ?>
				</tr>
				<?php }  ?>

			</tbody>
			<tfoot id="detalle_totales">

				<tr>
					<td colspan="3" class="textright"><span>SUBTOTAL</span></td>
					<td class="textright"><span>$<?php echo $precioFinal;  ?></span></td>
				</tr>
				<?php }  ?>
				<?php 
				$totalSumaImpuestos = 0;
				$id_factura= $detalleFactura->getIdFactura();
				 $listaFacturaImpuestos = FacturaImpuestos::obtenerPorIdFactura($id_factura);
					foreach($listaFacturaImpuestos as $facturaImpuestos){

					?>
				<tr>
					<td colspan="3" class="textright">
						<span><?php echo $facturaImpuestos->tiposImpositivos->getDescripcion(); 
						echo " "; 
						echo $facturaImpuestos->getValorPorcentaje();  ?> %</span>
					</td>
					<td class="textright">
						<span>$<?php 
						$valorPorcentajeImpuesto= $facturaImpuestos->getValorPorcentaje();
						$totalImpuesto= $precioFinal * $valorPorcentajeImpuesto / 100;
       					$totalSumaImpuestos= $totalSumaImpuestos + $totalImpuesto;
       					echo $totalImpuesto;  ?></span>
					</td>
				</tr>
				<?php }  ?>
			
				<tr>
					<td colspan="3" class="textright"><span>TOTAL </span></td>
					<td class="textright"><span>$<?php $total=  $totalSumaImpuestos + $precioFinal;
					echo $total; ?></span></td>
				</tr>
				
		</tfoot>
	</table>
	<div>
		<p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con nombre, teléfono y Email</p>
		<h4 class="label_gracias">¡Gracias por su compra!</h4>
	</div>

</div>

</body>
</html>
<?php
 
// Instanciamos un objeto de la clase DOMPDF.
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$pdf = new DOMPDF($options);
 
// Definimos el tamaño y orientación del papel que queremos.
$pdf->set_paper("letter", "portrait");
//$pdf->set_paper(array(0,0,104,250));
 
// Cargamos el contenido HTML.
$pdf->load_html(ob_get_clean());
 
// Renderizamos el documento PDF.
$pdf->render();
 
// Enviamos el fichero PDF al navegador.
$pdf->stream('reportePdf.pdf');


function file_get_contents_curl($url) {
	$crl = curl_init();
	$timeout = 5;
	curl_setopt($crl, CURLOPT_URL, $url);
	curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
	$ret = curl_exec($crl);
	curl_close($crl);
	return $ret;
}

?>
