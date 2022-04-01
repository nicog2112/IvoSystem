function validarDomicilioModificar() 
{
const formulario = document.getElementById('formularioModificar');
const inputs = document.querySelectorAll('#formularioModificar input');
const selectPaisModificar = document.getElementById('paisModificar');
const selectProvinciaModificar = document.getElementById('provinciaModificar');
const selectLocalidadModificar = document.getElementById('localidadModificar');
const selectBarrioModificar = document.getElementById('barrioModificar');

const expresiones = {

	calle: /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/, //Se permiten Letras y espacios en el medio, pueden llevar acentos y minimo son 3 caracteres.
	altura: /^\d{1,10}$/, // Letras y espacios, pueden llevar acentos.
	manzana: /^[a-zA-Z0-9]{1,30}$/, // 8 a 10 numeros.
	casa: /^[a-zA-Z0-9]{1,30}$/, // Letras y espacios, pueden llevar acentos.cuit: /^\d{8,11}$/, // 8 a 10 numeros.
	torre: /^[a-zA-Z0-9]{1,30}$/, // Fecha aaaa-mm-dd
	piso: /^[a-zA-Z0-9]{1,30}$/, // Fecha aaaa-mm-dd


}

const campos = {
	
	calleModificar: false,
	alturaModificar: false,
	manzanaModificar: false,
	casaModificar: false,
	torreModificar: false,
	pisoModificar: false
	


}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		case "calleModificar":
			validarCampo(expresiones.calle, e.target, 'calleModificar');
		break;
		case "alturaModificar":
			validarCampo(expresiones.altura, e.target, 'alturaModificar');
		break;
		case "manzanaModificar":
			validarCampo(expresiones.manzana, e.target, 'manzanaModificar');
		break;
		case "casaModificar":
			validarCampo(expresiones.casa, e.target, 'casaModificar');
		break;		
		case "torreModificar":
			validarCampo(expresiones.torre, e.target, 'torreModificar');
		break;
		case "pisoModificar":
			validarCampo(expresiones.piso, e.target, 'pisoModificar');
		break;
		case "paisModificar":
			validarPaisModificar();
		break;
		case "provinciaModificar":
			validarProvincia();
		break;
		case "localidadModificar":
			validarLocalidad();
		break;
		case "barrioModificar":
			validarBarrio();
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

	const validarPaisModificar = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("paisModificar").value;
		if(cod == "NULL" || cod == "" || cod == 0){
	
		document.getElementById(`grupo__paisModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__paisModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__paisModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__paisModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__paisModificar .formulario__input-error`).classList.add('formulario__input-error-activo');

		document.getElementById(`grupo__provinciaModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__provinciaModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__provinciaModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__provinciaModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__provinciaModificar .formulario__input-error`).classList.add('formulario__input-error-activo');

		document.getElementById(`grupo__localidadModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__localidadModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__localidadModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__localidadModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__localidadModificar .formulario__input-error`).classList.add('formulario__input-error-activo');


		document.getElementById(`grupo__barrioModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__barrioModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__barrioModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__barrioModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__barrioModificar .formulario__input-error`).classList.add('formulario__input-error-activo');

		campos['paisModificar'] = false;
		campos['provinciaModificar'] = false;
		campos['localidadModificar'] = false;
		campos['barrioModificar'] = false;
	} else {
		document.getElementById(`grupo__paisModificar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__paisModificar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__paisModificar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__paisModificar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__paisModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['paisModificar'] = true;

		}
 
		}

	const validarProvincia = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("provinciaModificar").value;
		if(cod == "NULL" || cod == ""  || cod == 0){
	
		document.getElementById(`grupo__provinciaModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__provinciaModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__provinciaModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__provinciaModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__provinciaModificar .formulario__input-error`).classList.add('formulario__input-error-activo');

		document.getElementById(`grupo__localidadModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__localidadModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__localidadModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__localidadModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__localidadModificar .formulario__input-error`).classList.add('formulario__input-error-activo');


		document.getElementById(`grupo__barrioModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__barrioModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__barrioModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__barrioModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__barrioModificar .formulario__input-error`).classList.add('formulario__input-error-activo');

		campos['provinciaModificar'] = false;
		campos['localidadModificar'] = false;
		campos['barrioModificar'] = false;
	} else {
		document.getElementById(`grupo__provinciaModificar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__provinciaModificar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__provinciaModificar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__provinciaModificar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__provinciaModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['provinciaModificar'] = true;
		}
 
		}

	const validarLocalidad = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("localidadModificar").value;
		if(cod == "NULL" || cod == "" || cod == 0){
	
		document.getElementById(`grupo__localidadModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__localidadModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__localidadModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__localidadModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__localidadModificar .formulario__input-error`).classList.add('formulario__input-error-activo');



		document.getElementById(`grupo__barrioModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__barrioModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__barrioModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__barrioModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__barrioModificar .formulario__input-error`).classList.add('formulario__input-error-activo');

		campos['localidadModificar'] = false;
		campos['barrioModificar'] = false;
	} else {
		document.getElementById(`grupo__localidadModificar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__localidadModificar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__localidadModificar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__localidadModificar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__localidadModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['localidadModificar'] = true;
		}
 
		}

	const validarBarrio = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("barrioModificar").value;
		if(cod == "NULL" || cod == "" || cod == 0){
	
		document.getElementById(`grupo__barrioModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__barrioModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__barrioModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__barrioModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__barrioModificar .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['barrioModificar'] = false;
	} else {
		document.getElementById(`grupo__barrioModificar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__barrioModificar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__barrioModificar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__barrioModificar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__barrioModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['barrioModificar'] = true;
		}
 
		}





inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);

});
selectPaisModificar.addEventListener('mouseup', validarFormulario);
selectProvinciaModificar.addEventListener('mouseup', validarFormulario);
selectLocalidadModificar.addEventListener('mouseup', validarFormulario);
selectBarrioModificar.addEventListener('mouseup', validarFormulario);

function validarCompletoDomicilio() {
	var paisModificar = document.getElementById('paisModificar');
	var provinciaModificar = document.getElementById('provinciaModificar');
	var localidadModificar = document.getElementById('localidadModificar');
	var barrioModificar = document.getElementById('barrioModificar');
	var calleModificar = document.getElementById("calleModificar").value;
	var alturaModificar = document.getElementById("alturaModificar").value;
	var manzanaModificar = document.getElementById("manzanaModificar").value;
	var casaModificar = document.getElementById("casaModificar").value;
	var torreModificar = document.getElementById("torreModificar").value;
	
	
	var expreCalle = /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/; //Se permiten Letras y espacios en el medio, pueden llevar acentos y minimo son 3 caracteres.
	var expreAltura = /^\d{1,10}$/; // Letras y espacios, pueden llevar acentos.
	var expreManzana = /^[a-zA-Z0-9]{1,30}$/; // 8 a 10 numeros.
	var expreCasa = /^[a-zA-Z0-9]{1,30}$/; // Letras y espacios, pueden llevar acentos.cuit: /^\d{8,11}$/, // 8 a 10 numeros.
	var expreTorre = /^[a-zA-Z0-9]{1,30}$/; // Fecha aaaa-mm-dd
	var exprePiso = /^[a-zA-Z0-9]{1,30}$/; // Fecha aaaa-mm-dd
	validarPaisModificar();
	validarProvincia();
	validarLocalidad();
	validarBarrio();
	if(expreCalle.test(calleModificar) && expreAltura.test(alturaModificar)){


		document.getElementById(`grupo__calleModificar`).classList.remove('formulario__grupo-incorrecto');
	document.getElementById(`grupo__calleModificar`).classList.add('formulario__grupo-correcto');
	document.querySelector(`#grupo__calleModificar i`).classList.add('fa-check-circle');
	document.querySelector(`#grupo__calleModificar i`).classList.remove('fa-times-circle');
	document.querySelector(`#grupo__calleModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');


	document.getElementById(`grupo__alturaModificar`).classList.remove('formulario__grupo-incorrecto');
	document.getElementById(`grupo__alturaModificar`).classList.add('formulario__grupo-correcto');
	document.querySelector(`#grupo__alturaModificar i`).classList.add('fa-check-circle');
	document.querySelector(`#grupo__alturaModificar i`).classList.remove('fa-times-circle');
	document.querySelector(`#grupo__alturaModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');

	
	campos.calleModificar = true;
	campos.alturaModificar = true;

} if (expreManzana.test(manzanaModificar) && expreCasa.test(casaModificar)) {
	document.getElementById(`grupo__manzanaModificar`).classList.remove('formulario__grupo-incorrecto');
	document.getElementById(`grupo__manzanaModificar`).classList.add('formulario__grupo-correcto');
	document.querySelector(`#grupo__manzanaModificar i`).classList.add('fa-check-circle');
	document.querySelector(`#grupo__manzanaModificar i`).classList.remove('fa-times-circle');
	document.querySelector(`#grupo__manzanaModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');


	document.getElementById(`grupo__casaModificar`).classList.remove('formulario__grupo-incorrecto');
	document.getElementById(`grupo__casaModificar`).classList.add('formulario__grupo-correcto');
	document.querySelector(`#grupo__casaModificar i`).classList.add('fa-check-circle');
	document.querySelector(`#grupo__casaModificar i`).classList.remove('fa-times-circle');
	document.querySelector(`#grupo__casaModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');

	
	campos.manzanaModificar = true;
	campos.casaModificar = true;
} if (expreTorre.test(torreModificar) && exprePiso.test(pisoModificar)) {
	document.getElementById(`grupo__torreModificar`).classList.remove('formulario__grupo-incorrecto');
	document.getElementById(`grupo__torreModificar`).classList.add('formulario__grupo-correcto');
	document.querySelector(`#grupo__torreModificar i`).classList.add('fa-check-circle');
	document.querySelector(`#grupo__torreModificar i`).classList.remove('fa-times-circle');
	document.querySelector(`#grupo__torreModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');


	document.getElementById(`grupo__pisoModificar`).classList.remove('formulario__grupo-incorrecto');
	document.getElementById(`grupo__pisoModificar`).classList.add('formulario__grupo-correcto');
	document.querySelector(`#grupo__pisoModificar i`).classList.add('fa-check-circle');
	document.querySelector(`#grupo__pisoModificar i`).classList.remove('fa-times-circle');
	document.querySelector(`#grupo__pisoModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');

	
	campos.torreModificar = true;
	campos.pisoModificar = true;
}
}


formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	validarCompletoDomicilio();
	
	if( campos.paisModificar && campos.provinciaModificar && campos.localidadModificar && campos.barrioModificar && 
		((campos.calleModificar && campos.alturaModificar) || 
	 (campos.manzanaModificar  && campos.casaModificar) || (campos.torreModificar  && campos.pisoModificar))){
		

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