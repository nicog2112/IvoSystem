 <?php

require_once "../../class/Talle.php";
require_once "../../class/Cliente.php";
require_once "../../class/Empleado.php";
require_once "../../class/Venta.php";

require_once "../../class/ProductoTalle.php";
require_once "../../class/TipoFactura.php";
require_once "../../class/EstadosPago.php";
require_once "../../class/TipoPago.php";
require_once "../../class/TiposImpositivos.php";
require_once "../../class/Producto.php";
require_once "../../class/Factura.php";
require_once "../../class/Venta.php";

$listadoTiposImpositivos = TiposImpositivos::obtenerPorEstado();

$listadoTalle = Talle::obtenerTodos();
$listadoClientes = Cliente::obtenerTodos();
$listadoEmpleados = Empleado::obtenerTodos();
$listadoTipoFactura = TipoFactura::obtenerTodosActivos();
$listadoEstadosPagos = EstadosPagos::obtenerTodos();
$listadoTipoPago = TipoPago::obtenerTodosActivos();
$listadoProductos = Producto::obtenerTodos();



$id_venta= $_GET["id"];
$venta= Venta::obtenerPorId($id_venta);
 ?>
 <form action="./terminarVenta.php" method="POST" id="formulario">
                        
                         <input name="idVenta" type="hidden" value="<?php echo $id_venta;?>">
                        <input name="total" type="hidden" value="<?php echo $venta->getTotal();?>">
                        <input name="estado" type="hidden" value="1">
                        <input type="hidden" name="cliente" value="<?php echo $venta->getIdCliente(); ?>">

                        <!-- Grupo: TipoFactura -->
                        <div class="formulario__grupo" id="grupo__TipoFactura" >
                            <label for="tipoFactura" class="formulario__label">Tipo de Factura</label>
                            <div class="formulario__grupo-input">
                                <select name="tipoFactura" id="tipoFactura" class="formulario__input" required>
                                    <option value="">---Seleccionar---</option>

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
                            
                            <div class="formulario__grupo-input">
                                <input type="hidden" name="tipoPago" id="tipoPago" class="formulario__input" value="1">
                                   

                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <br>
                            <p class="formulario__input-error">El TIPO PAGO no puede estar vacio. Seleccione una opcion</p>
                        </div>

                       
                        <?php 
                        $facturaNumeracion= Factura::obtenerUltimaNumeracion();
                         ?>
                        <input type="hidden" class="formulario__input" name="numeracion" id="numeracion" value="<?php echo $facturaNumeracion->getNumeracion(); ?>"  >




                        <input type="hidden" name="promocion" value="1">
                        <br><br>
                        <button type="submit" class="botonGuardar">Terminar venta</button>
                        <a href="./cancelarVenta.php" class="botonCancelar">Cancelar venta</a>
                        
                        <br><br>
                    </form>