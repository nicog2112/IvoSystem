function validarFormularioNuevoProveedor() 
{
	
const formulario = document.getElementById('formularioAñadir');
const inputs = document.querySelectorAll('#formularioAñadir input');

const expresiones = {

	nombre: /^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/, //Se permiten Letras y espacios en el medio, pueden llevar acentos y minimo son 3 caracteres.
	cuit: /^\d{8,11}$/, // 8 a 10 numeros.
	
}

const campos = {
	
	nombreAñadir: false,
	cuitAñadir: false,

}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		case "nombreAñadir":
			validarCampo(expresiones.nombre, e.target, 'nombreAñadir');
		break;
		case "cuitAñadir":
			validarCampo(expresiones.cuit, e.target, 'cuitAñadir');
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


inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);

});

formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	
	
	if(campos.nombreAñadir  && campos.cuitAñadir){
		
		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
		}, 5000);

		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
		
		});
		document.getElementById("formularioAñadir").submit();
	} else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
		}, 1000);
	}

});

}