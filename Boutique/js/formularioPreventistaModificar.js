function validarPreventistaModificar() 
{
const formulario = document.getElementById('formularioModificar');
const inputs = document.querySelectorAll('#formularioModificar input');
const selectSexoPersonaModificar = document.getElementById('sexoPersonaModificar');

const expresiones = {

	nombre: /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/, //Se permiten Letras y espacios en el medio, pueden llevar acentos y minimo son 3 caracteres.
	apellido: /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/, // Letras y espacios, pueden llevar acentos.
	dni: /^\d{8,10}$/, // 8 a 10 numeros.
	nacionalidad: /^[a-zA-ZÀ-ÿ\s]{0,20}$/, // Letras y espacios, pueden llevar acentos.cuit: /^\d{8,11}$/, // 8 a 10 numeros.
	fechaNacimiento: /^\d{4}([\-/.])(0?[1-9]|1[1-2])\1(3[01]|[12][0-9]|0?[1-9])$/, // Fecha aaaa-mm-dd


}

const campos = {
	
	nombrePersonaModificar: false,
	apellidoPersonaModificar: false,
	dniPersonaModificar: false,
	nacionalidadPersonaModificar: false,
	fechaNacimientoPersonaModificar: false
	


}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		case "nombrePersonaModificar":
			validarCampo(expresiones.nombre, e.target, 'nombrePersonaModificar');
		break;
		case "apellidoPersonaModificar":
			validarCampo(expresiones.apellido, e.target, 'apellidoPersonaModificar');
		break;
		case "dniPersonaModificar":
			validarCampo(expresiones.dni, e.target, 'dniPersonaModificar');
		break;
		case "nacionalidadPersonaModificar":
			validarCampo(expresiones.nacionalidad, e.target, 'nacionalidadPersonaModificar');
		break;		
		case "fechaNacimientoPersonaModificar":
			validarCampo(expresiones.fechaNacimiento, e.target, 'fechaNacimientoPersonaModificar');
		break;
		case "sexoPersonaModificar":
			validarSexo();
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
		var cod = document.getElementById("sexoPersonaModificar").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__sexoPersonaModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__sexoPersonaModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__sexoPersonaModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__sexoPersonaModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__sexoPersonaModificar .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['sexoPersonaModificar'] = false;
	} else {
		document.getElementById(`grupo__sexoPersonaModificar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__sexoPersonaModificar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__sexoPersonaModificar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__sexoPersonaModificar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__sexoPersonaModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['sexoPersonaModificar'] = true;
		}
 
		}





inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});
selectSexoPersonaModificar.addEventListener('click', validarFormulario);


function validarCompleto() {
	var nombrePersona = document.getElementById("nombrePersonaModificar").value;
	var apellidoPersona = document.getElementById("apellidoPersonaModificar").value;
	var dniPersona = document.getElementById("dniPersonaModificar").value;
	var nacionalidadPersona = document.getElementById("nacionalidadPersonaModificar").value;
	var fechaNacimientoPersona = document.getElementById("fechaNacimientoPersonaModificar").value;
	
	
	var expreNombre = /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/; //Se permiten Letras y espacios en el medio, pueden llevar acentos y minimo son 3 caracteres.
	var expreApellido = /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/; // Letras y espacios, pueden llevar acentos.
	var expreDni = /^\d{8,10}$/; // 8 a 10 numeros.
	var expreNacionalidad = /^[a-zA-ZÀ-ÿ\s]{0,20}$/; // Letras y espacios, pueden llevar acentos.cuit: /^\d{8,11}$/, // 8 a 10 numeros.
	var expreFechaNacimiento = /^\d{4}([\-/.])(0?[1-9]|1[1-2])\1(3[01]|[12][0-9]|0?[1-9])$/; // Fecha aaaa-mm-dd
	
	if(expreNombre.test(nombrePersona) && expreApellido.test(apellidoPersona) && expreDni.test(dniPersona) && expreNacionalidad.test(nacionalidadPersona) ){


		document.getElementById(`grupo__nombrePersonaModificar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__nombrePersonaModificar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__nombrePersonaModificar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__nombrePersonaModificar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__nombrePersonaModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');


		document.getElementById(`grupo__apellidoPersonaModificar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__apellidoPersonaModificar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__apellidoPersonaModificar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__apellidoPersonaModificar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__apellidoPersonaModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');

		document.getElementById(`grupo__dniPersonaModificar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__dniPersonaModificar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__dniPersonaModificar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__dniPersonaModificar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__dniPersonaModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');

		
	
		campos.nombrePersonaModificar = true;
		campos.apellidoPersonaModificar = true;
		campos.dniPersonaModificar = true;

	}
}




formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	validarCompleto();
	
	if(campos.nombrePersonaModificar  && campos.apellidoPersonaModificar && campos.dniPersonaModificar ){
		

		document.getElementById('formulario__mensaje-exitoModificar').classList.add('formulario__mensaje-exito-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje-exitoModificar').classList.remove('formulario__mensaje-exito-activo');
		}, 5000);

		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
			document.getElementById("formularioModificar").submit();
		});
	}  else {
		document.getElementById('formulario__mensajeModificar').classList.add('formulario__mensaje-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensajeModificar').classList.remove('formulario__mensaje-activo');
		}, 1000);
		
	}

});

}