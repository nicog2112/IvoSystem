function validarContacto() 
{
const formulario = document.getElementById('formularioAñadir');
const inputs = document.querySelectorAll('#formularioAñadir input');
const selectTipoContacto = document.getElementById('cboTipoContacto');

const expresiones = {

	
	valorNuevo:/^[^$%&|<>#\s]{3,30}$/,
}

const campos = {
	

	valorNuevo: false,
	

}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
	
		case "valorNuevo":
			validarCampo(expresiones.valorNuevo, e.target, 'valorNuevo');
		break;
		
		case "cboTipoContacto":
			validarTipoContacto();
		break;

		
	}
}

	const validarTipoContacto = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("cboTipoContacto").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__cboTipoContactoNuevo`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cboTipoContactoNuevo`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__cboTipoContactoNuevo i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__cboTipoContactoNuevo i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__cboTipoContactoNuevo .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['cboTipoContacto'] = false;
	} else {
		document.getElementById(`grupo__cboTipoContactoNuevo`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cboTipoContactoNuevo`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__cboTipoContactoNuevo i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__cboTipoContactoNuevo i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__cboTipoContactoNuevo .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['cboTipoContacto'] = true;
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
selectTipoContacto.addEventListener('click', validarFormulario);
formulario.addEventListener('submit', (e) => {
	e.preventDefault();

	
	if(campos.valorNuevo){
		

		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
		}, 5000);

		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
			document.getElementById("formularioAñadir").submit();
		});
	}  else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
		}, 1000);
		
	}

});

}