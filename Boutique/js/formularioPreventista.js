function validarPreventistaNuevo() 
{
const formulario = document.getElementById('formularioNuevo');
const inputs = document.querySelectorAll('#formularioNuevo input');
const selectSexoPersona = document.getElementById('sexoPersona');

const expresiones = {

	nombre: /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/, //Se permiten Letras y espacios en el medio, pueden llevar acentos y minimo son 3 caracteres.
	apellido: /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/, // Letras y espacios, pueden llevar acentos.
	dni: /^\d{8,10}$/, // 8 a 10 numeros.
	nacionalidad: /^[a-zA-ZÀ-ÿ\s]{0,20}$/, // Letras y espacios, pueden llevar acentos.cuit: /^\d{8,11}$/, // 8 a 10 numeros.
	fechaNacimiento: /^\d{4}([\-/.])(0?[1-9]|1[1-2])\1(3[01]|[12][0-9]|0?[1-9])$/, // Fecha aaaa-mm-dd


}

const campos = {
	
	nombrePersona: false,
	apellidoPersona: false,
	dniPersona: false,
	nacionalidadPersona: false,
	fechaNacimientoPersona: false
	


}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		case "nombrePersona":
			validarCampo(expresiones.nombre, e.target, 'nombrePersona');
		break;
		case "apellidoPersona":
			validarCampo(expresiones.apellido, e.target, 'apellidoPersona');
		break;
		case "dniPersona":
			validarCampo(expresiones.dni, e.target, 'dniPersona');
		break;
		case "nacionalidadPersona":
			validarCampo(expresiones.nacionalidad, e.target, 'nacionalidadPersona');
		break;		
		case "fechaNacimientoPersona":
			validarCampo(expresiones.fechaNacimiento, e.target, 'fechaNacimientoPersona');
		break;
		case "sexoPersona":
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
		var cod = document.getElementById("sexoPersona").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__sexoPersona`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__sexoPersona`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__sexoPersona i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__sexoPersona i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__sexoPersona .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['sexoPersona'] = false;
	} else {
		document.getElementById(`grupo__sexoPersona`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__sexoPersona`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__sexoPersona i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__sexoPersona i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__sexoPersona .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['sexoPersona'] = true;
		}
 
		}


function validarCompletoPersona(){
		var nacionalidadPersona = document.getElementById("nacionalidadPersona").value;
	
	
		var expreNacionalidadPersona =  /^[a-zA-ZÀ-ÿ\s]{0,20}$/; // Letras y espacios, pueden llevar acentos.cuit: /^\d{8,11}$/, // 8 a 10 numeros.

		if(expreNacionalidadPersona.test(nacionalidadPersona)){
			document.getElementById(`grupo__nacionalidadPersona`).classList.remove('formulario__grupo-incorrecto');
			document.getElementById(`grupo__nacionalidadPersona`).classList.add('formulario__grupo-correcto');
			document.querySelector(`#grupo__nacionalidadPersona i`).classList.add('fa-check-circle');
			document.querySelector(`#grupo__nacionalidadPersona i`).classList.remove('fa-times-circle');
			document.querySelector(`#grupo__nacionalidadPersona .formulario__input-error`).classList.remove('formulario__input-error-activo');

		campos.nacionalidadPersona = true;
	} 
}




inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});
selectSexoPersona.addEventListener('click', validarFormulario);

formulario.addEventListener('submit', (e) => {

	e.preventDefault();
	validarCompletoPersona();
	
	if(campos.nombrePersona  && campos.apellidoPersona && campos.dniPersona && campos.nacionalidadPersona){
		

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