function validarProductoTalleNuevo() 
{
const formulario = document.getElementById('formularioNuevo');
const inputs = document.querySelectorAll('#formularioNuevo input');
const selectTalle = document.getElementById('talleNuevo');

const expresiones = {

	cantidadMaximaNuevo: /^\d{1,5}$/, //Se permiten Letras y espacios en el medio, pueden llevar acentos y minimo son 3 caracteres.
	cantidadMinimaNuevo: /^\d{1,5}$/, // Letras y espacios, pueden llevar acentos.
	cantidadDisponibleNuevo: /^\d{1,5}$/, // 8 a 10 numeros.
	


}

const campos = {
	
	cantidadMaximaNuevo: false,
	cantidadMinimaNuevo: false,
	cantidadDisponibleNuevo: false,
	
	


}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		case "cantidadMaximaNuevo":
			validarCampo(expresiones.cantidadMaximaNuevo, e.target, 'cantidadMaximaNuevo');
		break;
		case "cantidadMinimaNuevo":
			validarCampo(expresiones.cantidadMinimaNuevo, e.target, 'cantidadMinimaNuevo');
		break;
		case "cantidadDisponibleNuevo":
			validarCampo(expresiones.cantidadDisponibleNuevo, e.target, 'cantidadDisponibleNuevo');
		break;
		case "talleNuevo":
			validarTalle();
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

	const validarTalle = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("talleNuevo").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__talleNuevo`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__talleNuevo`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__talleNuevo i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__talleNuevo i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__talleNuevo .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['talleNuevo'] = false;
	} else {
		document.getElementById(`grupo__talleNuevo`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__talleNuevo`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__talleNuevo i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__talleNuevo i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__talleNuevo .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['talleNuevo'] = true;
		}
 
		}





inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});
selectTalle.addEventListener('click', validarFormulario);

formulario.addEventListener('submit', (e) => {
	e.preventDefault();

	
	if(campos.cantidadMaximaNuevo  && campos.cantidadMinimaNuevo && campos.cantidadDisponibleNuevo ){
		

		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
		}, 5000);

		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
			document.getElementById("formularioNuevo").submit();
		});
	}  else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
		}, 1000);
		
	}

});

}