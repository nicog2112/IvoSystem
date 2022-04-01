function validarProductoModificar() 
{
const formulario = document.getElementById('formularioModificar');
const inputs = document.querySelectorAll('#formularioModificar input');
const selectCategoria= document.getElementById('nombreCategoriaModificar');
const selectTemporada= document.getElementById('nombreTemporadaModificar');

const expresiones = {

	nombreProductoModificar: /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/, //Se permiten Letras y espacios en el medio, pueden llevar acentos y minimo son 3 caracteres.
	marcaProductoModificar: /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/, // Letras y espacios, pueden llevar acentos.
	descripcionProductoModificar: /^([a-zA-ZÀ-ÿ]{3,20})+( [a-zA-ZÀ-ÿ]+)*$/,
	precioCompraModificar: /^\d{1,10}$/,
	precioVentaModificar: /^\d{1,10}$/,
	


}

const campos = {
	
	nombreProductoModificar: false,
	marcaProductoModificar: false,
	descripcionProductoModificar: false,
	precioCompraModificar: false,
	precioVentaModificar: false
	


}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		case "nombreProductoModificar":
			validarCampo(expresiones.nombreProductoModificar, e.target, 'nombreProductoModificar');
		break;
		case "marcaProductoModificar":
			validarCampo(expresiones.marcaProductoModificar, e.target, 'marcaProductoModificar');
		break;
		case "descripcionProductoModificar":
			validarCampo(expresiones.descripcionProductoModificar, e.target, 'descripcionProductoModificar');
		break;
		case "precioCompraModificar":
			validarCampo(expresiones.precioCompraModificar, e.target, 'precioCompraModificar');
		break;		
		case "precioVentaModificar":
			validarCampo(expresiones.precioVentaModificar, e.target, 'precioVentaModificar');
		break;
		case "nombreCategoriaModificar":
			validarCategoria();
		break;
		case "nombreTemporadaModificar":
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
		var cod = document.getElementById("nombreCategoriaModificar").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__nombreCategoriaModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__nombreCategoriaModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__nombreCategoriaModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__nombreCategoriaModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__nombreCategoriaModificar .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['nombreCategoriaModificar'] = false;
	} else {
		document.getElementById(`grupo__nombreCategoriaModificar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__nombreCategoriaModificar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__nombreCategoriaModificar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__nombreCategoriaModificar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__nombreCategoriaModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['nombreCategoriaModificar'] = true;
		}
 
		}


		const validarTemporada = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("nombreTemporadaModificar").value;
		if(cod == "NULL" || cod == ""){
	
		document.getElementById(`grupo__nombreTemporadaModificar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__nombreTemporadaModificar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__nombreTemporadaModificar i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__nombreTemporadaModificar i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__nombreTemporadaModificar .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['nombreTemporadaModificar'] = false;
	} else {
		document.getElementById(`grupo__nombreTemporadaModificar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__nombreTemporadaModificar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__nombreTemporadaModificar i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__nombreTemporadaModificar i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__nombreTemporadaModificar .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['nombreTemporadaModificar'] = true;
		}
 
		}





inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
	input.focus();
});
selectCategoria.addEventListener('click', validarFormulario);
selectTemporada.addEventListener('click', validarFormulario);

formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	validarCategoria();
	validarTemporada();
	
	if(campos.nombreProductoModificar  && campos.marcaProductoModificar && campos.descripcionProductoModificar && campos.precioCompraModificar 
		&& campos.precioVentaModificar  ){
		

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