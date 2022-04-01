// Formulario dinamico Mi perfil

		function HabilitarParte2(){	
			var contenedor = document.getElementById("parte2");	
			var contenedorActivo = document.getElementById("parte1");
		
			document.getElementById('paso2').classList.add('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}

		function HabilitarParte3(){	
			var contenedor = document.getElementById("parte3");	
			var contenedorActivo = document.getElementById("parte2");
			
			document.getElementById('paso3').classList.add('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}

		function HabilitarParte5(){	
			var contenedor = document.getElementById("parte4");	
			var contenedorActivo = document.getElementById("parte3");
			
			document.getElementById('paso4').classList.add('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}



		function HabilitarParte4(){	
			let modulo = document.getElementById("modulo").innerHTML; 
			var contenedor = document.getElementById("parte4");	
			var contenedorActivo = document.getElementById("parte3");
			var nombre = document.getElementById("nombreUsuario").value;
			var apellido = document.getElementById("apellidoUsuario").value
			var dni = document.getElementById("dniUsuario").value;
			var nacionalidad =  document.getElementById("nacionalidadUsuario").value;
			var fechaNacimiento =  document.getElementById("fechaNacimientoUsuario").value;
			var usuario =  document.getElementById("usernameUsuario").value;
			var sexo =  document.getElementById("sexoUsuario").selectedIndex;
			var sexo =  document.getElementById("sexoUsuario")[sexo].text;
			
			document.getElementById("mostrarNombre").innerHTML = nombre; 
			document.getElementById("mostrarApellido").innerHTML = apellido;
			document.getElementById("mostrarDNI").innerHTML = dni;
			document.getElementById("mostrarNacionalidad").innerHTML = nacionalidad;
			document.getElementById("mostrarFechaNacimiento").innerHTML = fechaNacimiento;
			document.getElementById("mostrarSexo").innerHTML = sexo;
			document.getElementById("mostrarUsuario").innerHTML = usuario;
				
			document.getElementById('paso4').classList.add('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}

		function VolverParte1(){	
			var contenedor = document.getElementById("parte1");	
			var contenedorActivo = document.getElementById("parte2");
			document.getElementById('paso2').classList.remove('active');
			
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}
		function VolverParte2(){	
			var contenedor = document.getElementById("parte2");	
			var contenedorActivo = document.getElementById("parte3");
			document.getElementById('paso3').classList.remove('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}
		function VolverParte3(){	
			var contenedor = document.getElementById("parte3");	
			var contenedorActivo = document.getElementById("parte4");
			document.getElementById('paso4').classList.remove('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}
		function VolverParte4(){	
			var contenedor = document.getElementById("parte4");	
			var contenedorActivo = document.getElementById("parte5");
			document.getElementById('paso5').classList.remove('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}



// Formulario dinamico Nuevo 

		function HabilitarParte2Nuevo(){	
			var contenedor = document.getElementById("parte2Nuevo");	
			var contenedorActivo = document.getElementById("parte1Nuevo");
		
			document.getElementById('paso2Nuevo').classList.add('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}

		function HabilitarParte3Nuevo(){	
			var contenedor = document.getElementById("parte3Nuevo");	
			var contenedorActivo = document.getElementById("parte2Nuevo");
			
			document.getElementById('paso3Nuevo').classList.add('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}

		function HabilitarParte5Nuevo(){	
			var contenedor = document.getElementById("parte4Nuevo");	
			var contenedorActivo = document.getElementById("parte3Nuevo");

			
			document.getElementById('paso4Nuevo').classList.add('activeNuevo');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}



		function HabilitarParte4Nuevo(){	
			let modulo = document.getElementById("modulo").innerHTML; 
			var contenedor = document.getElementById("parte4Nuevo");	
			var contenedorActivo = document.getElementById("parte3Nuevo");

			if(modulo == "preventistas" || modulo == "empleados" || modulo == "clientes" || modulo == "personas"){
			
			var nombre = document.getElementById("nombrePersona").value;
			var apellido = document.getElementById("apellidoPersona").value
			var dni = document.getElementById("dniPersona").value;
			var nacionalidad =  document.getElementById("nacionalidadPersona").value;
			var fechaNacimiento =  document.getElementById("fechaNacimientoPersona").value;
			var sexo =  document.getElementById("sexoPersona").selectedIndex;
			var sexo =  document.getElementById("sexoPersona")[sexo].text;
			
			
			
			document.getElementById("mostrarNombrePersona").innerHTML = nombre; 
			document.getElementById("mostrarApellidoPersona").innerHTML = apellido;
			document.getElementById("mostrarDNIPersona").innerHTML = dni;
			document.getElementById("mostrarNacionalidadPersona").innerHTML = nacionalidad;
			document.getElementById("mostrarFechaNacimientoPersona").innerHTML = fechaNacimiento;
			document.getElementById("mostrarSexoPersona").innerHTML = sexo;
			
			}else if (modulo == "domicilios" || modulo == "domiciliosProveedores"){
			var pais =  document.getElementById("lista1").selectedIndex;
			var pais =  document.getElementById("lista1")[pais].text;
			var provincia =  document.getElementById("select2lista").selectedIndex;
			var provincia =  document.getElementById("select2lista")[provincia].text;
			var localidad =  document.getElementById("select3lista").selectedIndex;
			var localidad =  document.getElementById("select3lista")[localidad].text;
			var barrio =  document.getElementById("select4lista").selectedIndex;
			var barrio =  document.getElementById("select4lista")[barrio].text;
			var calle = document.getElementById("calleNuevo").value;
			var altura = document.getElementById("alturaNuevo").value;
			var manzana =  document.getElementById("manzanaNuevo").value;
			var casa =  document.getElementById("casaNuevo").value;
			var torre =  document.getElementById("torreNuevo").value;
			var piso =  document.getElementById("pisoNuevo").value;
			

			document.getElementById("mostrarPais").innerHTML = pais; 
			document.getElementById("mostrarProvincia").innerHTML = provincia;
			document.getElementById("mostrarLocalidad").innerHTML = localidad;
			document.getElementById("mostrarBarrio").innerHTML = barrio;
			document.getElementById("mostrarCalle").innerHTML = calle;
			document.getElementById("mostrarAltura").innerHTML = altura;
			document.getElementById("mostrarManzana").innerHTML = manzana;
			document.getElementById("mostrarCasa").innerHTML = casa;
			document.getElementById("mostrarTorre").innerHTML = torre;
			document.getElementById("mostrarPiso").innerHTML = piso;
			
			}
			
			
			document.getElementById('paso4Nuevo').classList.add('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}

		function VolverParte1Nuevo(){	
			var contenedor = document.getElementById("parte1Nuevo");	
			var contenedorActivo = document.getElementById("parte2Nuevo");
			document.getElementById('paso2Nuevo').classList.remove('active');
			
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}
		function VolverParte2Nuevo(){	
			var contenedor = document.getElementById("parte2Nuevo");	
			var contenedorActivo = document.getElementById("parte3Nuevo");
			document.getElementById('paso3Nuevo').classList.remove('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}
		function VolverParte3Nuevo(){	
			var contenedor = document.getElementById("parte3Nuevo");	
			var contenedorActivo = document.getElementById("parte4Nuevo");
			document.getElementById('paso4Nuevo').classList.remove('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}
		function VolverParte4Nuevo(){	
			var contenedor = document.getElementById("parte4Nuevo");	
			var contenedorActivo = document.getElementById("parte5Nuevo");
			document.getElementById('paso5Nuevo').classList.remove('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}


// Formulario dinamico Modificar 

		function HabilitarParte2Modificar(){	
			var contenedor = document.getElementById("parte2Modificar");	
			var contenedorActivo = document.getElementById("parte1Modificar");
		
			document.getElementById('paso2Modificar').classList.add('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}

		function HabilitarParte3Modificar(){	
			var contenedor = document.getElementById("parte3Modificar");	
			var contenedorActivo = document.getElementById("parte2Modificar");
			
			document.getElementById('paso3Modificar').classList.add('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}

		function HabilitarParte5Modificar(){	
			var contenedor = document.getElementById("parte4Modificar");	
			var contenedorActivo = document.getElementById("parte3Modificar");

			
			document.getElementById('paso4Modificar').classList.add('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}



		function HabilitarParte4Modificar(){	
			let modulo = document.getElementById("modulo").innerHTML; 
			var contenedor = document.getElementById("parte4Modificar");	
			var contenedorActivo = document.getElementById("parte3Modificar");

			if(modulo == "preventistas" || modulo == "empleados" || modulo == "clientes" || modulo == "personas"){
			var nombre = document.getElementById("nombrePersonaModificar").value;
			var apellido = document.getElementById("apellidoPersonaModificar").value
			var dni = document.getElementById("dniPersonaModificar").value;
			var nacionalidad =  document.getElementById("nacionalidadPersonaModificar").value;
			var fechaNacimiento =  document.getElementById("fechaNacimientoPersonaModificar").value;
			var sexo =  document.getElementById("sexoPersonaModificar").selectedIndex;
			var sexo =  document.getElementById("sexoPersonaModificar")[sexo].text;
			
			document.getElementById("mostrarNombrePersonaModificar").innerHTML = nombre; 
			document.getElementById("mostrarApellidoPersonaModificar").innerHTML = apellido;
			document.getElementById("mostrarDNIPersonaModificar").innerHTML = dni;
			document.getElementById("mostrarNacionalidadPersonaModificar").innerHTML = nacionalidad;
			document.getElementById("mostrarFechaNacimientoPersonaModificar").innerHTML = fechaNacimiento;
			document.getElementById("mostrarSexoPersonaModificar").innerHTML = sexo;
			
			}else if(modulo == "domicilios" || modulo == "domiciliosProveedores"){
			var pais =  document.getElementById("paisModificar").selectedIndex;
			var pais =  document.getElementById("paisModificar")[pais].text;
			var provincia =  document.getElementById("provinciaModificar").selectedIndex;
			var provincia =  document.getElementById("provinciaModificar")[provincia].text;
			var localidad =  document.getElementById("localidadModificar").selectedIndex;
			var localidad =  document.getElementById("localidadModificar")[localidad].text;
			var barrio =  document.getElementById("barrioModificar").selectedIndex;
			var barrio =  document.getElementById("barrioModificar")[barrio].text;
			var calle = document.getElementById("calleModificar").value;
			var altura = document.getElementById("alturaModificar").value;
			var manzana =  document.getElementById("manzanaModificar").value;
			var casa =  document.getElementById("casaModificar").value;
			var torre =  document.getElementById("torreModificar").value;
			var piso =  document.getElementById("pisoModificar").value;
			

			document.getElementById("mostrarPaisModificar").innerHTML = pais; 
			document.getElementById("mostrarProvinciaModificar").innerHTML = provincia;
			document.getElementById("mostrarLocalidadModificar").innerHTML = localidad;
			document.getElementById("mostrarBarrioModificar").innerHTML = barrio;
			document.getElementById("mostrarCalleModificar").innerHTML = calle;
			document.getElementById("mostrarAlturaModificar").innerHTML = altura;
			document.getElementById("mostrarManzanaModificar").innerHTML = manzana;
			document.getElementById("mostrarCasaModificar").innerHTML = casa;
			document.getElementById("mostrarTorreModificar").innerHTML = torre;
			document.getElementById("mostrarPisoModificar").innerHTML = piso;

			}

			document.getElementById('paso4Modificar').classList.add('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}

		function VolverParte1Modificar(){	
			var contenedor = document.getElementById("parte1Modificar");	
			var contenedorActivo = document.getElementById("parte2Modificar");
			document.getElementById('paso2Modificar').classList.remove('active');
			
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}
		function VolverParte2Modificar(){	
			var contenedor = document.getElementById("parte2Modificar");	
			var contenedorActivo = document.getElementById("parte3Modificar");
			document.getElementById('paso3Modificar').classList.remove('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}
		function VolverParte3Modificar(){	
			var contenedor = document.getElementById("parte3Modificar");	
			var contenedorActivo = document.getElementById("parte4Modificar");
			document.getElementById('paso4Modificar').classList.remove('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}
		function VolverParte4Modificar(){	
			var contenedor = document.getElementById("parte4Modificar");	
			var contenedorActivo = document.getElementById("parte5Modificar");
			document.getElementById('paso5Modificar').classList.remove('active');
			contenedorActivo.style.display = "none";		
			contenedor.style.display = "block";		
			return true;	}


