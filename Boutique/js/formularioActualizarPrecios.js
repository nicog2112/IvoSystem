function validarActualizacionPrecios() 
{
const formulario = document.getElementById('formularioNuevo');
const inputs = document.querySelectorAll('#formularioNuevo input');
const selectcboMetodo = document.getElementById('cboMetodo');
const selectcboMetodoActualizar = document.getElementById('cboMetodoActualizar');
const selectcategoriaAplicar = document.getElementById('categoriaAplicar');
const selectTemporadaAplicar = document.getElementById('temporadaAplicar');

const expresiones = {

	marcaNuevo: /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/, //Se permiten Letras y espacios en el medio, pueden llevar acentos y minimo son 3 caracteres.
	valorFijoAplicar: /^\d{1,10}$/, // Letras y espacios, pueden llevar acentos.
	porcentajeAplicar: /^\d{1,10}$/,

}

const campos = {
	
	marcaNuevo: false,
	valorFijoAplicar: false,
	porcentajeAplicar: false,
	
	


}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		case "marcaNuevo":
			validarCampo(expresiones.marcaNuevo, e.target, 'marcaNuevo');
		break;
		case "valorFijoAplicar":
			validarCampo(expresiones.valorFijoAplicar, e.target, 'valorFijoAplicar');
		break;
		case "porcentajeAplicar":
			validarCampo(expresiones.porcentajeAplicar, e.target, 'porcentajeAplicar');
		break;
		
		case "cboMetodo":
			validarcboMetodo();
		break;
		case "cboMetodoActualizar":
			validarcboMetodoActualizar();
		break;
		case "categoriaAplicar":
			validarcategoriaAplicar();
		break;
		case "temporadaAplicar":
			validartemporadaAplicar();
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

	const validarcboMetodo = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("cboMetodo").value;
		if(cod == "NULL" || cod == "" || cod == 0){
	
		document.getElementById(`grupo__cboMetodo`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cboMetodo`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__cboMetodo i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__cboMetodo i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__cboMetodo .formulario__input-error`).classList.add('formulario__input-error-activo');

		

		campos['cboMetodo'] = false;
		
	} else {
		document.getElementById(`grupo__cboMetodo`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cboMetodo`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__cboMetodo i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__cboMetodo i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__cboMetodo .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['cboMetodo'] = true;
		}
 
		}

	const validarcboMetodoActualizar = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("cboMetodoActualizar").value;
		if(cod == "NULL" || cod == ""  || cod == 0){
	
		document.getElementById(`grupo__cboMetodoActualizar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cboMetodoActualizar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__cboMetodoActualizar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__cboMetodoActualizar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__cboMetodoActualizar .formulario__input-error`).classList.add('formulario__input-error-activo');

		campos['cboMetodoActualizar'] = false;
		
	} else {
		document.getElementById(`grupo__cboMetodoActualizar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cboMetodoActualizar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__cboMetodoActualizar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__cboMetodoActualizar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__cboMetodoActualizar .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['cboMetodoActualizar'] = true;
		}
 
		}

	const validarcategoriaAplicar= () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("categoriaAplicar").value;
		if(cod == "NULL" || cod == "" || cod == 0){
	
		document.getElementById(`grupo__categoriaAplicar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__categoriaAplicar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__categoriaAplicar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__categoriaAplicar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__categoriaAplicar .formulario__input-error`).classList.add('formulario__input-error-activo');


		campos['categoriaAplicar'] = false;

	} else {
		document.getElementById(`grupo__categoriaAplicar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__categoriaAplicar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__categoriaAplicar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__categoriaAplicar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__categoriaAplicar .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['categoriaAplicar'] = true;
		}
 
		}

	const validartemporadaAplicar = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("temporadaAplicar").value;
		if(cod == "NULL" || cod == "" || cod == 0){
	
		document.getElementById(`grupo__temporadaAplicar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__temporadaAplicar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__temporadaAplicar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__temporadaAplicar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__temporadaAplicar .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['temporadaAplicar'] = false;
	} else {
		document.getElementById(`grupo__temporadaAplicar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__temporadaAplicar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__temporadaAplicar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__temporadaAplicar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__temporadaAplicar .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['temporadaAplicar'] = true;
		}
 
		}





inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});
selectcboMetodo.addEventListener('click', validarFormulario);
selectcboMetodoActualizar.addEventListener('click', validarFormulario);
selectcategoriaAplicar.addEventListener('click', validarFormulario);
selectTemporadaAplicar.addEventListener('click', validarFormulario);

formulario.addEventListener('submit', (e) => {
	e.preventDefault();

	
	if( campos.cboMetodo && (campos.categoriaAplicar || campos.temporadaAplicar 
		|| campos.marcaNuevo) && campos.cboMetodoActualizar && (campos.valorFijoAplicar || campos.porcentajeAplicar) )  {
		

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