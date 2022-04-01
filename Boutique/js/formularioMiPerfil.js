function validarMiPerfil() 
{
	
	const formulario = document.getElementById('formularioMiPerfil');
	const inputs = document.querySelectorAll('#formularioMiPerfil input');
	const selectSexo = document.getElementById('sexoUsuario');

	const expresiones = {

	nombre: /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/, //Se permiten Letras y espacios en el medio, pueden llevar acentos y minimo son 3 caracteres.
	apellido: /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/, // Letras y espacios, pueden llevar acentos.
	dni: /^\d{8,10}$/, // 8 a 10 numeros.
	nacionalidad: /^[a-zA-ZÀ-ÿ\s]{3,20}$/, // Letras y espacios, pueden llevar acentos.cuit: /^\d{8,11}$/, // 8 a 10 numeros.
	fechaNacimiento: /^\d{4}([\-/.])(0?[1-9]|1[1-2])\1(3[01]|[12][0-9]|0?[1-9])$/, // Fecha aaaa-mm-dd
	usuario: /^[a-zA-Z0-9\_\-]{4,10}$/, // Letras, numeros, guion y guion_bajo
	password: /^.{4,12}$/, // 4 a 12 digitos.
}



const campos = {
	
	nombreUsuario: false,
	apellidoUsuario: false,
	dniUsuario: false,
	nacionalidadUsuario: false,
	fechaNacimientoUsuario: false,
	usernameUsuario: false,
	passwordUsuario: false
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		case "nombreUsuario":
			validarCampo(expresiones.nombre, e.target, 'nombreUsuario');
		break;
		case "apellidoUsuario":
			validarCampo(expresiones.apellido, e.target, 'apellidoUsuario');
		break;
		case "dniUsuario":
			validarCampo(expresiones.dni, e.target, 'dniUsuario');
		break;
		case "nacionalidadUsuario":
			validarCampo(expresiones.nacionalidad, e.target, 'nacionalidadUsuario');
		break;
		case "fechaNacimientoUsuario":
			validarCampo(expresiones.fechaNacimiento, e.target, 'fechaNacimientoUsuario');
		break;
		case "usernameUsuario":
			validarCampo(expresiones.usuario, e.target, 'usernameUsuario');
		break;
		case "passwordUsuario":
			validarCampo(expresiones.password, e.target, 'passwordUsuario');
		break;
		case "sexoUsuario":
			validarSexoUsuario();
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

const validarSexoUsuario = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("sexoUsuario").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__sexoUsuario`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__sexoUsuario`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__sexoUsuario i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__sexoUsuario i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__sexoUsuario .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['sexoUsuario'] = false;
	} else {
		document.getElementById(`grupo__sexoUsuario`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__sexoUsuario`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__sexoUsuario i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__sexoUsuario i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__sexoUsuario .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['sexoUsuario'] = true;
		}
 
		}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
	input.addEventListener('click', validarFormulario);


});

selectSexo.addEventListener('click', validarFormulario);

function validarCompleto() {
	var nombreUser = document.getElementById("nombreUsuario").value;
	var apellidoUser = document.getElementById("apellidoUsuario").value;
	var dniUser = document.getElementById("dniUsuario").value;
	var nacionalidadUser = document.getElementById("nacionalidadUsuario").value;
	var fechaNacimientoUser = document.getElementById("fechaNacimientoUsuario").value;
	var usuarioUser = document.getElementById("usernameUsuario").value;
	var passwordUser = document.getElementById("passwordUsuario").value;
	
	var expreNombre = /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/; //Se permiten Letras y espacios en el medio, pueden llevar acentos y minimo son 3 caracteres.
	var expreApellido = /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/; // Letras y espacios, pueden llevar acentos.
	var expreDni = /^\d{8,10}$/; // 8 a 10 numeros.
	var expreNacionalidad = /^[a-zA-ZÀ-ÿ\s]{3,20}$/; // Letras y espacios, pueden llevar acentos.cuit: /^\d{8,11}$/, // 8 a 10 numeros.
	var expreFechaNacimiento = /^\d{4}([\-/.])(0?[1-9]|1[1-2])\1(3[01]|[12][0-9]|0?[1-9])$/; // Fecha aaaa-mm-dd
	var expreUsuario = /^[a-zA-Z0-9\_\-]{4,10}$/; // Letras, numeros, guion y guion_bajo
	var exprePassword =/^.{4,12}$/; // 4 a 12 digitos.
	if(expreNombre.test(nombreUser) && expreApellido.test(apellidoUser) && expreDni.test(dniUser)
	 && expreNacionalidad.test(nacionalidadUser) && expreFechaNacimiento.test(fechaNacimientoUser)&& expreUsuario.test(usuarioUser)
	 && exprePassword.test(passwordUser) ){
		document.getElementById(`grupo__nombreUsuario`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__nombreUsuario`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__nombreUsuario i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__nombreUsuario i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__nombreUsuario .formulario__input-error`).classList.remove('formulario__input-error-activo');


		document.getElementById(`grupo__apellidoUsuario`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__apellidoUsuario`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__apellidoUsuario i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__apellidoUsuario i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__apellidoUsuario .formulario__input-error`).classList.remove('formulario__input-error-activo');

		document.getElementById(`grupo__dniUsuario`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__dniUsuario`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__dniUsuario i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__dniUsuario i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__dniUsuario .formulario__input-error`).classList.remove('formulario__input-error-activo');

		document.getElementById(`grupo__nacionalidadUsuario`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__nacionalidadUsuario`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__nacionalidadUsuario i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__nacionalidadUsuario i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__nacionalidadUsuario .formulario__input-error`).classList.remove('formulario__input-error-activo');

		document.getElementById(`grupo__fechaNacimientoUsuario`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__fechaNacimientoUsuario`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__fechaNacimientoUsuario i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__fechaNacimientoUsuario i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__fechaNacimientoUsuario .formulario__input-error`).classList.remove('formulario__input-error-activo');

		document.getElementById(`grupo__usernameUsuario`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__usernameUsuario`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__usernameUsuario i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__usernameUsuario i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__usernameUsuario .formulario__input-error`).classList.remove('formulario__input-error-activo');

		document.getElementById(`grupo__passwordUsuario`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__passwordUsuario`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__passwordUsuario i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__passwordUsuario i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__passwordUsuario .formulario__input-error`).classList.remove('formulario__input-error-activo');

		campos.nombreUsuario = true;
		campos.apellidoUsuario = true;
		campos.dniUsuario = true;
		campos.nacionalidadUsuario = true;
		campos.fechaNacimientoUsuario = true;
		campos.usernameUsuario = true;
		campos.passwordUsuario = true;

	}
}

formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	validarCompleto();

	if(campos.nombreUsuario  && campos.apellidoUsuario  && campos.dniUsuario && campos.usernameUsuario && campos.passwordUsuario ){
		

		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
		setTimeout(() => {
			
			
			document.getElementById("formularioMiPerfil").submit();
	
		}, 1000);

		
	}  else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
		}, 1000);
		
	}

});

}
