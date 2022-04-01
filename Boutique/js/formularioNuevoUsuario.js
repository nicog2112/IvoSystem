function validarNuevoUsuario() 
{
	
	const formulario = document.getElementById('formularioNuevo');
	const inputs = document.querySelectorAll('#formularioNuevo input');
	const selectCliente = document.getElementById('cliente');
	const selectEmpleado = document.getElementById('Empleado');

	const expresiones = {

	
	usuario: /^[a-zA-Z0-9\_\-]{4,10}$/, // Letras, numeros, guion y guion_bajo
	password: /^.{4,12}$/, // 4 a 12 digitos.
}



const campos = {
	
	
	username: false,
	password: false
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		
		case "username":
			validarCampo(expresiones.usuario, e.target, 'username');
		break;
		case "password":
			validarCampo(expresiones.password, e.target, 'password');
		break;
		case "cliente":
			validarClienteNuevo();
		break;
		case "Empleado":
			validarEmpleadoNuevo();
		break;

	}
}

const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[campo] = false;
	}
}

const validarClienteNuevo = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("cliente").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__cliente`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cliente`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__cliente i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__cliente i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__cliente .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['cliente'] = false;
	} else {
		document.getElementById(`grupo__cliente`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cliente`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__cliente i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__cliente i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__cliente .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['cliente'] = true;
		}
 
		}

const validarEmpleadoNuevo = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("Empleado").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__Empleado`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__Empleado`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__Empleado i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__Empleado i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__Empleado .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['Empleado'] = false;
	} else {
		document.getElementById(`grupo__Empleado`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__Empleado`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__Empleado i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__Empleado i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__Empleado .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['Empleado'] = true;
		}
 
		}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
	input.addEventListener('click', validarFormulario);


});



formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	validarClienteNuevo();
	validarEmpleadoNuevo();

	if(campos.username && campos.password && (campos.Empleado || campos.cliente)){
		

		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
		setTimeout(() => {
			
			
			document.getElementById("formularioNuevo").submit();
	
		}, 1000);

		
	}  else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
		}, 1000);
		
	}

});

}
