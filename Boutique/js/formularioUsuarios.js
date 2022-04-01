const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {

	nombre: /^[a-zA-ZÀ-ÿ\s]{3,40}$/, // Letras y espacios, pueden llevar acentos.
	apellido: /^[a-zA-ZÀ-ÿ\s]{3,40}$/, // Letras y espacios, pueden llevar acentos.
	dni: /^\d{8,10}$/, // 8 a 10 numeros.
	nacionalidad: /^[a-zA-ZÀ-ÿ\s]{3,40}$/, // Letras y espacios, pueden llevar acentos.
	fechaAlta: /^\d{4}([\-/.])(0?[1-9]|1[1-2])\1(3[01]|[12][0-9]|0?[1-9])$/, // Fecha aaaa-mm-dd
	fechaNacimiento: /^\d{4}([\-/.])(0?[1-9]|1[1-2])\1(3[01]|[12][0-9]|0?[1-9])$/, // Fecha aaaa-mm-dd


}

const campos = {
	
	nombre: false,
	apellido: false,
	dni: false,
	nacionalidad: false,
	fechaAlta: false,
	fechaNacimiento: false,
	


}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		case "nombre":
			validarCampo(expresiones.nombre, e.target, 'nombre');
		break;
		case "apellido":
			validarCampo(expresiones.apellido, e.target, 'apellido');
		break;
		case "dni":
			validarCampo(expresiones.dni, e.target, 'dni');
		break;
		case "nacionalidad":
			validarCampo(expresiones.nacionalidad, e.target, 'nacionalidad');
		break;
		case "fechaAlta":
			validarCampo(expresiones.fechaAlta, e.target, 'fechaAlta');
		break;
		case "fechaNacimiento":
			validarCampo(expresiones.fechaNacimiento, e.target, 'fechaNacimiento');
		break;
		case "sexo":
			validarSexo();
		break;
		case "estado":
			validarEstado();
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

		const validarSexo = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("sexo").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__sexo`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__sexo`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__sexo i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__sexo i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__sexo .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['sexo'] = false;
	} else {
		document.getElementById(`grupo__sexo`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__sexo`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__sexo i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__sexo i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__sexo .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['sexo'] = true;
		}
 
		}


		const validarEstado = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("estado").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__estado`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__estado`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__estado i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__estado i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__estado .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['estado'] = false;
	} else {
		document.getElementById(`grupo__estado`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__estado`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__estado i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__estado i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__estado .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['estado'] = true;
		}
 
		}



inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
	input.addEventListener('onclick', validarFormulario);
});

formulario.addEventListener('submit', (e) => {
	e.preventDefault();

	const terminos = document.getElementById('terminos');
	if(campos.nombre  && campos.apellido && campos.dni && campos.nacionalidad && campos.fechaAlta && 
		campos.fechaNacimiento && campos.sexo && campos.estado){
		

		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
		}, 5000);

		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
		document.formulario.submit();
		});
	} else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
	}

});

