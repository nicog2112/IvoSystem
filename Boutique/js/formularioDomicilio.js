function validarDomicilioNuevo() 
{
const formulario = document.getElementById('formularioNuevo');
const inputs = document.querySelectorAll('#formularioNuevo input');
const selectPais = document.getElementById('lista1');
const selectProvincia = document.getElementById('select2lista');
const selectLocalidad = document.getElementById('select3lista');
const selectBarrio = document.getElementById('select4lista');

const expresiones = {

	calle: /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/, //Se permiten Letras y espacios en el medio, pueden llevar acentos y minimo son 3 caracteres.
	altura: /^\d{1,10}$/, // Letras y espacios, pueden llevar acentos.
	manzana: /^[a-zA-Z0-9]{1,30}$/, // 8 a 10 numeros.
	casa: /^[a-zA-Z0-9]{1,30}$/, // Letras y espacios, pueden llevar acentos.cuit: /^\d{8,11}$/, // 8 a 10 numeros.
	torre: /^[a-zA-Z0-9]{1,30}$/, // Fecha aaaa-mm-dd
	piso: /^[a-zA-Z0-9]{1,30}$/, // Fecha aaaa-mm-dd


}

const campos = {
	
	calleNuevo: false,
	alturaNuevo: false,
	manzanaNuevo: false,
	casaNuevo: false,
	torreNuevo: false,
	pisoNuevo: false
	


}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		case "calleNuevo":
			validarCampo(expresiones.calle, e.target, 'calleNuevo');
		break;
		case "alturaNuevo":
			validarCampo(expresiones.altura, e.target, 'alturaNuevo');
		break;
		case "manzanaNuevo":
			validarCampo(expresiones.manzana, e.target, 'manzanaNuevo');
		break;
		case "casaNuevo":
			validarCampo(expresiones.casa, e.target, 'casaNuevo');
		break;		
		case "torreNuevo":
			validarCampo(expresiones.torre, e.target, 'torreNuevo');
		break;
		case "pisoNuevo":
			validarCampo(expresiones.piso, e.target, 'pisoNuevo');
		break;
		case "lista1":
			validarPais();
		break;
		case "select2lista":
			validarProvincia();
		break;
		case "select3lista":
			validarLocalidad();
		break;
		case "select4lista":
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

	const validarPais = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("lista1").value;
		if(cod == "NULL" || cod == "" || cod == 0){
	
		document.getElementById(`grupo__lista1`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__lista1`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__lista1 i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__lista1 i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__lista1 .formulario__input-error`).classList.add('formulario__input-error-activo');

		document.getElementById(`grupo__select2lista`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__select2lista`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__select2lista i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__select2lista i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__select2lista .formulario__input-error`).classList.add('formulario__input-error-activo');

		document.getElementById(`grupo__select3lista`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__select3lista`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__select3lista i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__select3lista i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__select3lista .formulario__input-error`).classList.add('formulario__input-error-activo');


		document.getElementById(`grupo__select4lista`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__select4lista`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__select4lista i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__select4lista i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__select4lista .formulario__input-error`).classList.add('formulario__input-error-activo');

		campos['lista1'] = false;
		campos['select2lista'] = false;
		campos['select3lista'] = false;
		campos['select4lista'] = false;
	} else {
		document.getElementById(`grupo__lista1`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__lista1`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__lista1 i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__lista1 i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__lista1 .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['lista1'] = true;
		}
 
		}

	const validarProvincia = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("select2lista").value;
		if(cod == "NULL" || cod == ""  || cod == 0){
	
		document.getElementById(`grupo__select2lista`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__select2lista`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__select2lista i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__select2lista i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__select2lista .formulario__input-error`).classList.add('formulario__input-error-activo');

		document.getElementById(`grupo__select3lista`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__select3lista`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__select3lista i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__select3lista i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__select3lista .formulario__input-error`).classList.add('formulario__input-error-activo');


		document.getElementById(`grupo__select4lista`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__select4lista`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__select4lista i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__select4lista i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__select4lista .formulario__input-error`).classList.add('formulario__input-error-activo');

		campos['select2lista'] = false;
		campos['select3lista'] = false;
		campos['select4lista'] = false;
	} else {
		document.getElementById(`grupo__select2lista`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__select2lista`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__select2lista i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__select2lista i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__select2lista .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['select2lista'] = true;
		}
 
		}

	const validarLocalidad = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("select3lista").value;
		if(cod == "NULL" || cod == "" || cod == 0){
	
		document.getElementById(`grupo__select3lista`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__select3lista`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__select3lista i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__select3lista i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__select3lista .formulario__input-error`).classList.add('formulario__input-error-activo');



		document.getElementById(`grupo__select4lista`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__select4lista`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__select4lista i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__select4lista i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__select4lista .formulario__input-error`).classList.add('formulario__input-error-activo');

		campos['select3lista'] = false;
		campos['select4lista'] = false;
	} else {
		document.getElementById(`grupo__select3lista`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__select3lista`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__select3lista i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__select3lista i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__select3lista .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['select3lista'] = true;
		}
 
		}

	const validarBarrio = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("select4lista").value;
		if(cod == "NULL" || cod == "" || cod == 0){
	
		document.getElementById(`grupo__select4lista`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__select4lista`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__select4lista i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__select4lista i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__select4lista .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['select4lista'] = false;
	} else {
		document.getElementById(`grupo__select4lista`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__select4lista`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__select4lista i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__select4lista i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__select4lista .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['select4lista'] = true;
		}
 
		}





inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});
selectPais.addEventListener('click', validarFormulario);
selectProvincia.addEventListener('click', validarFormulario);
selectLocalidad.addEventListener('click', validarFormulario);
selectBarrio.addEventListener('click', validarFormulario);

formulario.addEventListener('submit', (e) => {
	e.preventDefault();

	
	if( campos.lista1 && campos.select2lista && campos.select3lista && campos.select4lista && ((campos.calleNuevo && campos.alturaNuevo) || 
	 (campos.manzanaNuevo  && campos.casaNuevo) || (campos.torreNuevo  && campos.pisoNuevo))){
		

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