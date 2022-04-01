function validarFormularioProveedor() 
{
	
	const formulario = document.getElementById('formulario');
	const inputs = document.querySelectorAll('#formulario input');

	const expresiones = {

	nombre: /^([a-zA-ZÀ-ÿ]{3,40})+( [a-zA-ZÀ-ÿ]+)*$/, //Se permiten Letras y espacios en el medio, pueden llevar acentos y minimo son 3 caracteres.
	cuit: /^\d{8,11}$/, // 8 a 10 numeros.

}



const campos = {
	
	nombre: false,
	cuit: false,

}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		case "nombre":
		validarCampo(expresiones.nombre, e.target, 'nombre');
		break;
		case "cuit":
		validarCampo(expresiones.cuit, e.target, 'cuit');
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
	input.focus();
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);


});


formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	

	if(campos.nombre  && campos.cuit){
		

		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
		}, 5000);

		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
			document.getElementById("formulario").submit();
		});
	}  else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
	}

});

}


