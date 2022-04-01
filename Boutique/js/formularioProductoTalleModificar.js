function validarProductoTalleModificar() 
{
const formulario = document.getElementById('formularioModificar');
const inputs = document.querySelectorAll('#formularioModificar input');
const selectTalle = document.getElementById('talleModificar');

const expresiones = {

	cantidadMaximaModificar: /^\d{1,5}$/, //Se permiten Letras y espacios en el medio, pueden llevar acentos y minimo son 3 caracteres.
	cantidadMinimaModificar: /^\d{1,5}$/, // Letras y espacios, pueden llevar acentos.
	cantidadDisponibleModificar: /^\d{1,5}$/, // 8 a 10 numeros.
	


}

const campos = {
	
	cantidadMaximaModificar: false,
	cantidadMinimaModificar: false,
	cantidadDisponibleModificar: false,
	
	


}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		case "cantidadMaximaModificar":
			validarCampo(expresiones.cantidadMaximaModificar, e.target, 'cantidadMaximaModificar');
		break;
		case "cantidadMinimaModificar":
			validarCampo(expresiones.cantidadMinimaModificar, e.target, 'cantidadMinimaModificar');
		break;
		case "cantidadDisponibleModificar":
			validarCampo(expresiones.cantidadDisponibleModificar, e.target, 'cantidadDisponibleModificar');
		break;
		case "talleModificar":
			validarTalleModificar();
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

	const validarTalleModificar = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("talleModificar").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__talleModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__talleModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__talleModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__talleModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__talleModificar .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['talleModificar'] = false;
	} else {
		document.getElementById(`grupo__talleModificar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__talleModificar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__talleModificar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__talleModificar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__talleModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['talleModificar'] = true;
		}
 
		}





inputs.forEach((input) => {
	input.focus();
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);

});
selectTalle.addEventListener('click', validarFormulario);

formulario.addEventListener('submit', (e) => {
	e.preventDefault();

	
	if(campos.cantidadMaximaModificar  && campos.cantidadMinimaModificar && campos.cantidadDisponibleModificar ){
		

		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
		}, 5000);

		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
			document.getElementById("formularioModificar").submit();
		});
	}  else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
		}, 1000);
		
	}

});

}