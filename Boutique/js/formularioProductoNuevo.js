function validarProductoNuevo() 
{
const formulario = document.getElementById('formularioNuevo');
const inputs = document.querySelectorAll('#formularioNuevo input');
const selectCategoria= document.getElementById('nombreCategoria');
const selectTemporada= document.getElementById('temporadaNuevo');

const expresiones = {

	nombreProductoNuevo: /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/, //Se permiten Letras y espacios en el medio, pueden llevar acentos y minimo son 3 caracteres.
	marcaProductoNuevo: /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/, // Letras y espacios, pueden llevar acentos.
	descripcionProductoNuevo: /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/,
	precioCompraNuevo: /^\d{1,10}$/,
	precioVentaNuevo: /^\d{1,10}$/,
	


}

const campos = {
	
	nombreProductoNuevo: false,
	marcaProductoNuevo: false,
	descripcionProductoNuevo: false,
	precioCompraNuevo: false,
	precioVentaNuevo: false
	


}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		case "nombreProductoNuevo":
			validarCampo(expresiones.nombreProductoNuevo, e.target, 'nombreProductoNuevo');
		break;
		case "marcaProductoNuevo":
			validarCampo(expresiones.marcaProductoNuevo, e.target, 'marcaProductoNuevo');
		break;
		case "descripcionProductoNuevo":
			validarCampo(expresiones.descripcionProductoNuevo, e.target, 'descripcionProductoNuevo');
		break;
		case "precioCompraNuevo":
			validarCampo(expresiones.precioCompraNuevo, e.target, 'precioCompraNuevo');
		break;		
		case "precioVentaNuevo":
			validarCampo(expresiones.precioVentaNuevo, e.target, 'precioVentaNuevo');
		break;
		case "nombreCategoria":
			validarCategoria();
		break;
		case "temporadaNuevo":
			validarTemporada();
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

	const validarCategoria = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("nombreCategoria").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__nombreCategoria`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__nombreCategoria`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__nombreCategoria i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__nombreCategoria i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__nombreCategoria .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['nombreCategoria'] = false;
	} else {
		document.getElementById(`grupo__nombreCategoria`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__nombreCategoria`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__nombreCategoria i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__nombreCategoria i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__nombreCategoria .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['nombreCategoria'] = true;
		}
 
		}


		const validarTemporada = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("temporadaNuevo").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__temporadaNuevo`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__temporadaNuevo`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__temporadaNuevo i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__temporadaNuevo i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__temporadaNuevo .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['temporadaNuevo'] = false;
	} else {
		document.getElementById(`grupo__temporadaNuevo`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__temporadaNuevo`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__temporadaNuevo i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__temporadaNuevo i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__temporadaNuevo .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['temporadaNuevo'] = true;
		}
 
		}





inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});
selectCategoria.addEventListener('click', validarFormulario);
selectTemporada.addEventListener('click', validarFormulario);

formulario.addEventListener('submit', (e) => {
	e.preventDefault();

	
	if(campos.nombreProductoNuevo  && campos.marcaProductoNuevo && campos.descripcionProductoNuevo && campos.precioCompraNuevo 
		&& campos.precioVentaNuevo  ){
		

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