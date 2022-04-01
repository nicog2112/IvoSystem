function selectAnidados(){
	
		$("#lista1").change(function(){
			$('#select3lista').find('option').remove().end().append('<option value="whatever">-- SELECCIONE --</option>').val('whatever');
			$('#select4lista').find('option').remove().end().append('<option value="whatever">-- SELECCIONE --</option>').val('whatever');

			$.ajax({
			type:"POST",
			url:"datosDomicilio.php",
			data:"pais=" + $('#lista1').val(),
			success:function(r){
				$('#select2lista').html(r);}

			});
		});

		$("#select2lista").change(function(){
			$('#select4lista').find('option').remove().end().append('<option value="whatever">-- SELECCIONE --</option>').val('whatever');

			$.ajax({
			type:"POST",
			url:"datosDomicilio2.php",
			data:"provincia=" + $('#select2lista').val(),
			success:function(r){
				$('#select3lista').html(r);
			}
			});
		});

		$("#select3lista").change(function(){
			$.ajax({
			type:"POST",
			url:"datosDomicilio3.php",
			data:"localidad=" + $('#select3lista').val(),
			success:function(r){
				$('#select4lista').html(r);
			}
			});
		});
	};


	function selectAnidadosModificar(){
		validarDomicilioModificar();
		$("#paisModificar").change(function(){
			$('#localidadModificar').find('option').remove().end().append('<option value="whatever">-- SELECCIONE --</option>').val('whatever');
			$('#barrioModificar').find('option').remove().end().append('<option value="whatever">-- SELECCIONE --</option>').val('whatever');

			$.ajax({
			type:"POST",
			url:"datos.php",
			data:"pais=" + $('#paisModificar').val(),
			success:function(r){
				$('#provinciaModificar').html(r);}

			});
		});

		$("#provinciaModificar").change(function(){
			$('#barrioModificar').find('option').remove().end().append('<option value="whatever">-- SELECCIONE --</option>').val('whatever');

			$.ajax({
			type:"POST",
			url:"datos2.php",
			data:"provincia=" + $('#provinciaModificar').val(),
			success:function(r){
				$('#localidadModificar').html(r);
			}
			});
		});

		$("#localidadModificar").change(function(){
			$.ajax({
			type:"POST",
			url:"datos3.php",
			data:"localidad=" + $('#localidadModificar').val(),
			success:function(r){
				$('#barrioModificar').html(r);
			}
			});
		});
	};



	function selectAnidadosProducto(){
	
	
		$("#idProducto").change(function(){
			
			$.ajax({
			type:"POST",
			url:"datos.php",
			data:"producto=" + $('#idProducto').val(),
			success:function(r){
				$('#cboTalle').html(r);}

			});
		});

		$("#idProducto").change(function(){
			$('#cantidadDisponibleTalle').html('0');
			
			$.ajax({
			type:"POST",
			url:"datos2.php",
			data:"producto=" + $('#idProducto').val(),
			success:function(r){
				$('#cantidadDisponible').html(r);}

			});
		});

		$("#cboTalle").change(function(){
			
			$.ajax({
			type:"POST",
			url:"datos3.php",
			data:"talle=" + $('#cboTalle').val()+"&producto="+$('#idProducto').val(),
			success:function(r){
				$('#cantidadDisponibleTalle').html(r);}

			});
		});

		


		
	};

	function selectAnidadosProductoCompra(){
	
	
		$("#idProducto").change(function(){
			
			$.ajax({
			type:"POST",
			url:"datos.php",
			data:"producto=" + $('#idProducto').val(),
			success:function(r){
				$('#cboTalle').html(r);}

			});
		});

		$("#idProducto").change(function(){
			$('#cantidadMaximaTalle').html('0');
			
			$.ajax({
			type:"POST",
			url:"datos2.php",
			data:"producto=" + $('#idProducto').val(),
			success:function(r){
				$('#cantidadDisponible').html(r);}

			});
		});

		$("#cboTalle").change(function(){
			
			$.ajax({
			type:"POST",
			url:"datos3.php",
			data:"talle=" + $('#cboTalle').val()+"&producto="+$('#idProducto').val(),
			success:function(r){
				$('#cantidadMaximaTalle').html(r);}

			});
		});

		$("#cboTalle").change(function(){
			
			$.ajax({
			type:"POST",
			url:"datos4.php",
			data:"talle=" + $('#cboTalle').val()+"&producto="+$('#idProducto').val(),
			success:function(r){
				$('#cantidadDisponibleTalle').html(r);}

			});
		});

		


		
	};
