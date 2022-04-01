function validarContactoModificar() 
{
const formulario = document.getElementById('formularioModificar');
const inputs = document.querySelectorAll('#formularioModificar input');
const selectTipoContacto = document.getElementById('cboTipoContactoModificar');

const expresiones = {

	
	valorModificar:/^[^$%&|<>#\s]{3,30}$/,
}

const campos = {
	

	valorModificar: false,
	

}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
	
		case "valorModificar":
			validarCampo(expresiones.valorModificar, e.target, 'valorModificar');
		break;
		
		case "cboTipoContactoModificar":
			validarTipoContacto();
		break;

		
	}
}

	const validarTipoContacto = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("cboTipoContactoModificar").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__cboTipoContactoModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cboTipoContactoModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__cboTipoContactoModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__cboTipoContactoModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__cboTipoContactoModificar .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['cboTipoContactoModificar'] = false;
	} else {
		document.getElementById(`grupo__cboTipoContactoModificar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cboTipoContactoModificar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__cboTipoContactoModificar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__cboTipoContactoModificar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__cboTipoContactoModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['cboTipoContactoModificar'] = true;
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

	function validarCompletoContacto(){
		var valorModificar = document.getElementById("valorModificar").value;
	
	
		var expreValorModificar = /^[^$%&|<>#\s]{3,30}$/;

		if(expreValorModificar.test(valorModificar)){
			document.getElementById(`grupo__valorModificar`).classList.remove('formulario__grupo-incorrecto');
			document.getElementById(`grupo__valorModificar`).classList.add('formulario__grupo-correcto');
			document.querySelector(`#grupo__valorModificar i`).classList.add('fa-check-circle');
			document.querySelector(`#grupo__valorModificar i`).classList.remove('fa-times-circle');
			document.querySelector(`#grupo__valorModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');

		campos.valorModificar = true;
	} 
}


inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});
selectTipoContacto.addEventListener('click', validarFormulario);
formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	validarTipoContacto();
	validarCompletoContacto();
	
	if(campos.cboTipoContactoModificar && campos.valorModificar){
		

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