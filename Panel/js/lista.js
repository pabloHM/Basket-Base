$(function(){
	$("#loader").hide();
	var borrar=location.search.split("borrable=")[1].split("&")[0];
	var modal=location.search.split("tabla=")[1].split("&")[0];
	var sw="";
	if(modal=="clubs" || modal=="equipos" || modal=="partidos" || modal=="patrocinadores"){
		sw=location.search.split("sw=")[1].split("&")[0];

		if(borrar=="true" && sw=="0"){
			$("#listaEquipos").addClass('borrar');
		}
	}
	else if(borrar=="true" && (modal=="users" || modal=="noticias" || modal=="ofertas"))
		$("#listaEquipos").addClass('borrar');

	$(".borrar a").click(function(e){
		e.preventDefault();
		if($(this).text()!="No hay elementos disponibles."){
			var tabla='t'+$(this).attr('tabla');
			var id=$(this).attr('href').split("id=")[1].split("&")[0];
			$('#myModal').modal();
			$("#botonBorrar").click(function(e){
				e.preventDefault();
				$.ajax({
			        type: 'POST',
			        url: '../php/borrar.php',
			        data: 'modal='+tabla+'&id='+id,
			        success:function(data){
			        	if(data==1){
			        		location.reload();
			        	}
			        	console.log(data);
			        },
			        error:function(err){
			        	$("#errorLogup").show();
			            console.log(err);
			        }
			    });
			});
		}
	});

	$("#logout").click(function(e){
		e.preventDefault();
		$.ajax({
	        type: 'POST',
	        url: '../php/logout.php',
	        success:function(data){
	        	window.location.href="/";
	        },
	        error:function(err){
	            console.log(err);
	        }
	    });
	});
});