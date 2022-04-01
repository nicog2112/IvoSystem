  <?php

require_once "../../class/Sexo.php";

$listadoSexo = Sexo::obtenerTodos();

?>

  <div class="form-register__header">
    <ul class="progressbar">
        <li class="progressbar__option active" id="paso1">paso 1</li>
        <li class="progressbar__option" id="paso2">paso 2</li>
        <li class="progressbar__option" id="paso3">paso 3</li>
        <li class="progressbar__option" id="paso4">paso 4</li>
    </ul>

</div>
<form method="POST" action="../../modulos/miPerfil/procesar_modificacion.php"  enctype="multipart/form-data" class="form__reg" name="formulario" id="formularioMiPerfil">

    <div id="parte1" style="display:block;">
        <input type="hidden" name="idUsuario" value="<?php echo $usuarioCliente->getIdUsuario();?>">


        <!-- Grupo: Imagen -->
        <div class="formulario__grupo" id="grupo__imagenPerfil">
            <label for="ImagenPerfil" class="formulario__label">Imagen</label>
            <div class="formulario__grupo-input">
                <input type="file" class="formulario__input" id="files" name="ImagenPerfil" accept="image/*">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>

            <p class="formulario__input-error">La imagen tiene que ser jpg ,png</p>
        </div>

        <br>
        <!-- Grupo: Nombre -->
        <div class="formulario__grupo" id="grupo__nombreUsuario">
            <label for="nombreUsuario" class="formulario__label">Nombre</label>
            <div class="formulario__grupo-input">
                <input type="text" class="formulario__input" name="nombreUsuario" id="nombreUsuario" value="<?php echo $usuarioCliente->getNombre(); ?>">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>

            <p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
        </div>

        <br>

        <!-- Grupo: Apellido -->
        <div class="formulario__grupo" id="grupo__apellidoUsuario">
            <label for="apellidoUsuario" class="formulario__label">Apellido</label>
            <div class="formulario__grupo-input">
                <input type="text" class="formulario__input" name="apellidoUsuario" id="apellidoUsuario" value="<?php echo $usuarioCliente->getApellido(); ?>">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>

            <p class="formulario__input-error">El apellido tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
        </div>

        <br>
        <br>
        <button type="button" onclick="HabilitarParte2();" class="botonGuardar">Siguiente</button>

        <br>
    </div>

    <div id="parte2" style="display:none;">

        <!-- Grupo: DNI -->
        <div class="formulario__grupo" id="grupo__dniUsuario">
            <label for="dniUsuario" class="formulario__label">DNI</label>
            <div class="formulario__grupo-input">
                <input type="number" class="formulario__input" name="dniUsuario" id="dniUsuario" value="<?php echo $usuarioCliente->getDni(); ?>" >
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>

            <p class="formulario__input-error">El dni tiene que ser de 8 a 10 dígitos y no puede estar vacio</p>
        </div>
        <br>

        <!-- Grupo: Nacionalidad -->
        <div class="formulario__grupo" id="grupo__nacionalidadUsuario">
            <label for="nacionalidadUsuario" class="formulario__label">Nacionalidad</label>
            <div class="formulario__grupo-input">
                <input type="text" class="formulario__input" name="nacionalidadUsuario" id="nacionalidadUsuario" value="<?php echo $usuarioCliente->getNacionalidad(); ?>">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <br>
            <p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
        </div>

        <!-- Grupo: FechaNacimiento -->
        <div class="formulario__grupo" id="grupo__fechaNacimientoUsuario">
            <label for="fechaNacimientoUsuario" class="formulario__label" >Fecha de Nacimiento</label>
            <div class="formulario__grupo-input">
                <input type="date" class="formulario__input" name="fechaNacimientoUsuario" id="fechaNacimientoUsuario" value="<?php echo $usuarioCliente->getFechaNacimiento(); ?>">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <br>
            <p class="formulario__input-error">La fecha es incorrecta</p>
        </div>  

        <br>
        <button type="button" onclick="HabilitarParte3();" class="botonGuardar">Siguiente</button>
        <button type="button" onclick="VolverParte1();" class="botonCancelar">Anterior</button>
        <br>
    </div>
    <div id="parte3" style="display:none;">




        <!-- Grupo: Sexo -->
        <div class="formulario__grupo" id="grupo__sexoUsuario">
            <label for="sexoUsuario" class="formulario__label">Sexo</label>
            <div class="formulario__grupo-input">
                <select name="sexoUsuario" id="sexoUsuario" class="formulario__input">
                    <option value="NULL">---Seleccionar---</option>

                    <?php foreach ($listadoSexo as $sexo): ?>

                        <?php

                        $selected = "";

                        if ($sexo->getIdSexo() == $usuarioCliente->getIdSexo()) {
                            $selected = "SELECTED";}

                            ?>

                            <option <?php echo $selected; ?> value="<?php echo $sexo->getIdSexo(); ?>">
                                <?php echo $sexo->getDescripcion(); ?>
                            </option>

                        <?php endforeach ?>


                    </select>
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <br>
                <p class="formulario__input-error">El sexo no puede estar vacio. Seleccione una opcion</p>
            </div>

            <!-- Grupo: Usuario -->
            <div class="formulario__grupo" id="grupo__usernameUsuario">
                <label for="usernameUsuario" class="formulario__label">Usuario</label>
                <div class="formulario__grupo-input">
                    <input type="text" class="formulario__input" name="usernameUsuario" id="usernameUsuario" value="<?php echo $usuarioCliente->getUsername(); ?>">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>

                <p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
            </div>

            <br>

            <!-- Grupo: Password -->
            <div class="formulario__grupo" id="grupo__passwordUsuario">
                <label for="passwordUsuario" class="formulario__label">Contraseña</label>
                <div class="formulario__grupo-input">
                    <input type="password" class="formulario__input" name="passwordUsuario" id="passwordUsuario" value="<?php echo $usuarioCliente->getPassword(); ?>">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>

                <p class="formulario__input-error">El apellido tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
            </div>




            <br><br>

            <button type="button" onclick="HabilitarParte4();" class="botonGuardar">Siguiente</button>
            <button type="button" onclick="VolverParte2();" class="botonCancelar">Anterior</button>
            <br>
        </div>




        <div id="parte4" style="display:none;">
            <h4>Verifique que los datos ingresados sean correctos</h4>
            <table class="styled-table" style="font-size: 0.9rem;">
                <thead>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Nacionalidad</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Sexo</th>
                    <th>Usuario</th>
                </thead>
                <tbody>
                    <td><output id="list"><img class="thumb" src="/programacion_3/boutique/modulos/miPerfil/<?php echo $usuarioCliente->getImagen();  ?>"></output></td>
                    <td><p id="mostrarNombre"></p></td>
                    <td ><p id="mostrarApellido"></p></td>
                    <td><p id="mostrarDNI"></p></td>
                    <td><p id="mostrarNacionalidad"></p></td>
                    <td><p id="mostrarFechaNacimiento"></p></td>
                    <td><p id="mostrarSexo"></p></td>
                    <td><p id="mostrarUsuario"></p></td>
                </tbody>
            </table>


            <br>
            <div class="formulario__mensaje" id="formulario__mensaje">
                <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
            </div>
            <button type="button" onclick="VolverParte3();" class="botonCancelar">Anterior</button>

            <button type="submit" class="botonGuardar">Guardar</button>
            <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
            <br>

        </div> 


    </form>
</div>