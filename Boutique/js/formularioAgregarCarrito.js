function validarFormularioCarrito() 
{
const formulario = document.getElementById('formularioNuevo');
const inputs = document.querySelectorAll('#formularioNuevo input');
const selectIdProducto = document.getElementById('idProducto');
const selectTalle = document.getElementById('cboTalle');

const expresiones = {

	
	cantidad: /^([1-9]\d*)$/,

}

const campos = {
	
	cantidad: false,
	

}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		case "cantidad":
			validarCampo(expresiones.cantidad, e.target, 'cantidad');
		break;
		case "idProducto":
			validarIdProducto();
		break;
		case "cboTalle":
			validarTalle();
		break;
		
	}
}

const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		campos[campo] = false;
	}
}

const validarIdProducto = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("idProducto").value;
		if(cod == "NULL" || cod == ""){
	
		
		campos['idProducto'] = false;
	} else {
		
		campos['idProducto'] = true;
		}
 
		}


const validarTalle = () => {
			/* Para obtener el valor NULL*/
		var cod = document.getElementById("cboTalle").value;
		if(cod == "NULL" || cod == ""){
	
		
		campos['cboTalle'] = false;
	} else {
		
		campos['cboTalle'] = true;
		}
 
		}



inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	validarTalle();
	validarIdProducto();
	
	if(campos.cantidad && campos.idProducto && campos.cboTalle){
		

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