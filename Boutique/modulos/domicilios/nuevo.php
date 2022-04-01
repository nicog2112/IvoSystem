<?php
require_once "../../class/Domicilio.php";
require_once "../../class/PersonaDomicilio.php";
require_once "../../class/Empleado.php";
require_once "../../class/Barrio.php";
require_once "../../class/Localidad.php";
require_once "../../class/Provincia.php";
require_once "../../class/Pais.php";
$listadoPais = Pais::obtenerTodosActivos();

$listadoProvincia = Provincia::obtenerTodos();
$listadoLocalidad = Localidad::obtenerTodos();
$listadoBarrio = Barrio::obtenerTodos();

$persona= $_GET['id_persona'];
$id= $_GET['id'];
$moduloMenu= $_GET['modulo'];
?>

<div class="form-register__header">
    <ul class="progressbar">
        <li class="progressbar__option active" id="paso1Nuevo">paso 1</li>
        <li class="progressbar__option" id="paso2Nuevo">paso 2</li>
        <li class="progressbar__option" id="paso3Nuevo">paso 3</li>
        <li class="progressbar__option" id="paso4Nuevo">paso 4</li>
    </ul>

</div>
<form method="POST" action="procesar_alta.php"  enctype="multipart/form-data" class="form__reg" name="formulario" id="formularioNuevo" novalidate>

    <div id="parte1Nuevo" style="display:block;">
        <input type="hidden" name="idPersona" value="<?php echo $persona; ?>" >
         <input type="hidden" name="id" value="<?php echo $id; ?>" >
          <input type="hidden" name="moduloMenu" value="<?php echo $moduloMenu; ?>">



        <!-- Grupo: Pais -->
        <div class="formulario__grupo" id="grupo__lista1">
        	<label for="lista1" class="formulario__label">Pais *</label>
        	<div class="formulario__grupo-input">
        		<select id="lista1" name="lista1" class="formulario__input" required>
        			<option value=0>-- SELECCIONE --</option>

        			<?php foreach ($listadoPais as $pais): ?>

        				<option value="<?php echo $pais->getIdPais(); ?>">
        					<?php echo $pais->getDescripcion(); ?>
        				</option>

        			<?php endforeach ?>
        		</select>
        		<i class="formulario__validacion-estado fas fa-times-circle"></i>
        	</div>

        	<p class="formulario__input-error">El pais es obligatorio</p>
        </div>

        <!-- Grupo: Provincia -->
        <div class="formulario__grupo" id="grupo__select2lista">
            <label for="select2lista" class="formulario__label">Provincia *</label>
            <div class="formulario__grupo-input">
            	<select id="select2lista" class="formulario__input" name="select2lista" required>
      			<option value=0>-- SELECCIONE --</option>
   			</select>
               
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>

            <p class="formulario__input-error">La Provincia es obligatoria</p>
        </div>


        <!-- Grupo: Localidad -->
        <div class="formulario__grupo" id="grupo__select3lista">
        	<label for="select3lista" class="formulario__label">Localidad *</label>
        	<div class="formulario__grupo-input">
        		<select id="select3lista" class="formulario__input" name="select3lista" required>
        			<option value=0>-- SELECCIONE --</option>
        		</select>
        		<i class="formulario__validacion-estado fas fa-times-circle"></i>
        	</div>

        	<p class="formulario__input-error">La localidad es obligatoria</p>
        </div>

         <!-- Grupo: Barrio -->
        <div class="formulario__grupo" id="grupo__select4lista">
        	<label for="select4lista" class="formulario__label">Barrio *</label>
        	<div class="formulario__grupo-input">
        		<select id="select4lista" class="formulario__input" name="select4lista" required>
      			<option value=0>-- SELECCIONE --</option>
   			</select>
        		<i class="formulario__validacion-estado fas fa-times-circle"></i>
        	</div>

        	<p class="formulario__input-error">El barrio es obligatorio</p>
        </div>

        <br>
        <button type="button" onclick="HabilitarParte2Nuevo();" class="botonGuardar">Siguiente</button>

        <br>
    </div>

    <div id="parte2Nuevo" style="display:none;">

        <!-- Grupo: Calle -->
        <div class="formulario__grupo" id="grupo__calleNuevo">
            <label for="calleNuevo" class="formulario__label">Calle **</label>
            <div class="formulario__grupo-input">
            	<input type="text" name="calleNuevo" id="calleNuevo" placeholder="Calle" class="formulario__input">
            
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>

            <p class="formulario__input-error">Error de calle</p>
        </div>
        <br>

        <!-- Grupo: Altura -->
        <div class="formulario__grupo" id="grupo__alturaNuevo">
            <label for="alturaNuevo" class="formulario__label">Altura **</label>
            <div class="formulario__grupo-input">
            	<input type="text" name="alturaNuevo" id="alturaNuevo" placeholder="Altura" class="formulario__input">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <br>
            <p class="formulario__input-error">Error de Altura</p>
        </div>

        <!-- Grupo: Manzana -->
        <div class="formulario__grupo" id="grupo__manzanaNuevo">
            <label for="manzanaNuevo" class="formulario__label" >Manzana ***</label>
            <div class="formulario__grupo-input">
            	<input type="text" name="manzanaNuevo" id="manzanaNuevo"  placeholder="Manzana" class="formulario__input">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <br>
            <p class="formulario__input-error">La manzana introducida no es valida</p>
        </div>  

        <br>
        <button type="button" onclick="HabilitarParte3Nuevo();" class="botonGuardar">Siguiente</button>
        <button type="button" onclick="VolverParte1Nuevo();" class="botonCancelar">Anterior</button>
        <br>
    </div>
    <div id="parte3Nuevo" style="display:none;">




        <!-- Grupo: Casa -->
        <div class="formulario__grupo" id="grupo__casaNuevo">
            <label for="casaNuevo" class="formulario__label">Casa ***</label>
            <div class="formulario__grupo-input">
                <input type="text" name="casaNuevo" id="casaNuevo"  placeholder="Casa" class="formulario__input">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <br>
                <p class="formulario__input-error">La casa introducida es incorrecta</p>
            </div>

            <!-- Grupo: Torre -->
            <div class="formulario__grupo" id="grupo__torreNuevo">
                <label for="torreNuevo" class="formulario__label">Torre ****</label>
                <div class="formulario__grupo-input">
                   <input type="text" name="torreNuevo" id="torreNuevo" placeholder="Torre" class="formulario__input">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>

                <p class="formulario__input-error">La torre introducida es incorrecta</p>
            </div>

            <br>

            <!-- Grupo: Piso -->
            <div class="formulario__grupo" id="grupo__pisoNuevo">
                <label for="pisoNuevo" class="formulario__label">Piso ****</label>
                <div class="formulario__grupo-input">
                    <input type="text" name="pisoNuevo"id="pisoNuevo" placeholder="Piso" class="formulario__input">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>

                <p class="formulario__input-error">El piso introducido es incorrecto</p>
            </div>




            <br><br>

            <button type="button" onclick="HabilitarParte4Nuevo();" class="botonGuardar">Siguiente</button>
            <button type="button" onclick="VolverParte2Nuevo();" class="botonCancelar">Anterior</button>
            <br>
        </div>




        <div id="parte4Nuevo" style="display:none;">
            <h4>Verifique que los datos ingresados sean correctos</h4>
            <table class="styled-table" style="font-size: 0.9rem;">
                <thead>
                    <th>Pais</th>
                    <th>Provincia</th>
                    <th>Localidad</th>
                    <th>Barrio</th>
                    <th>Calle</th>
                    <th>Altura</th>
                    <th>Manzana</th>
                    <th>Casa</th>
                    <th>Torre</th>
                    <th>Piso</th>

                </thead>
                <tbody>
                    <td><p id="mostrarPais"></p></td>
                    <td ><p id="mostrarProvincia"></p></td>
                    <td><p id="mostrarLocalidad"></p></td>
                    <td><p id="mostrarBarrio"></p></td>
                    <td><p id="mostrarCalle"></p></td>
                    <td><p id="mostrarAltura"></p></td>
                    <td><p id="mostrarManzana"></p></td>
                    <td><p id="mostrarCasa"></p></td>
                    <td><p id="mostrarTorre"></p></td>
                    <td><p id="mostrarPiso"></p></td>

                </tbody>
            </table>


            <br>
            <div class="formulario__mensaje" id="formulario__mensaje">
                <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
            </div>
            <button type="button" onclick="VolverParte3Nuevo();" class="botonCancelar">Anterior</button>

            <button type="submit" class="botonGuardar">Guardar</button>
            <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
            <br>

        </div> 


    </form>
</div>


