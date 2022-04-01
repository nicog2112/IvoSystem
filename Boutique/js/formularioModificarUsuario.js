function validarModificarUsuario() 
{
	
	const formulario = document.getElementById('formularioModificar');
	const inputs = document.querySelectorAll('#formularioModificar input');
	const selectCliente = document.getElementById('clienteModificar');
	const selectEmpleado = document.getElementById('EmpleadoModificar');

	const expresiones = {

	
	usuarioModificar: /^[a-zA-Z0-9\_\-]{4,10}$/, // Letras, numeros, guion y guion_bajo
	passwordModificar: /^.{4,12}$/, // 4 a 12 digitos.
}



const campos = {
	
	
	usernameModif: false,
	passwordModif: false
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		
		case "usernameModif":
			validarCampo(expresiones.usuarioModificar, e.target, 'usernameModif');
		break;
		case "passwordModif":
			validarCampo(expresiones.passwordModificar, e.target, 'passwordModif');
		break;
		case "clienteModificar":
			validarClienteModificar();
		break;
		case "EmpleadoModificar":
			validarEmpleadoModificar();
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

const validarClienteModificar = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("clienteModificar").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__clienteModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__clienteModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__clienteModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__clienteModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__clienteModificar .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['clienteModificar'] = false;
	} else {
		document.getElementById(`grupo__clienteModificar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__clienteModificar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__clienteModificar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__clienteModificar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__clienteModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['clienteModificar'] = true;
		}
 
		}

const validarEmpleadoModificar = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("EmpleadoModificar").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__EmpleadoModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__EmpleadoModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__EmpleadoModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__EmpleadoModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__EmpleadoModificar .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['EmpleadoModificar'] = false;
	} else {
		document.getElementById(`grupo__EmpleadoModificar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__EmpleadoModificar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__EmpleadoModificar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__EmpleadoModificar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__EmpleadoModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['EmpleadoModificar'] = true;
		}
 
		}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
	input.addEventListener('click', validarFormulario);

	input.focus();
});



formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	validarClienteModificar();
	validarEmpleadoModificar();

	if(campos.usernameModif && campos.passwordModif && (campos.EmpleadoModificar || campos.clienteModificar)){
		

		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
		setTimeout(() => {
			
			
			document.getElementById("formularioModificar").submit();
	
		}, 1000);

		
	}  else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
		}, 1000);
		
	}

});

}
