	function HabilitarReporteAnual(){	
			var divAño = document.getElementById("graficoAnual");	
			var divMes = document.getElementById("graficoMensual");
			var divSemana= document.getElementById("graficoSemanal");
			var divDia = document.getElementById("graficoDia");
		
			divMes.style.display = "none";
			divSemana.style.display = "none";
			divDia.style.display = "none";		
			divAño.style.display = "block";		
	
		}

	function HabilitarReporteMensual(){	
			var divAño = document.getElementById("graficoAnual");	
			var divMes = document.getElementById("graficoMensual");
			var divSemana= document.getElementById("graficoSemanal");
			var divDia = document.getElementById("graficoDia");
		
		
			divMes.style.display = "block";
			divSemana.style.display = "none";
			divDia.style.display = "none";		
			divAño.style.display = "none";		

		}

	function HabilitarReporteSemanal(){	
			var divAño = document.getElementById("graficoAnual");	
			var divMes = document.getElementById("graficoMensual");
			var divSemana= document.getElementById("graficoSemanal");
			var divDia = document.getElementById("graficoDia");
		
		
			divMes.style.display = "none";
			divSemana.style.display = "block";
			divDia.style.display = "none";		
			divAño.style.display = "none";		

		}

	function HabilitarReporteDia(){	
			var divAño = document.getElementById("graficoAnual");	
			var divMes = document.getElementById("graficoMensual");
			var divSemana= document.getElementById("graficoSemanal");
			var divDia = document.getElementById("graficoDia");
		
		
			divMes.style.display = "none";
			divSemana.style.display = "none";
			divDia.style.display = "block";		
			divAño.style.display = "none";		

		}

