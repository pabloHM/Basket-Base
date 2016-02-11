$(function(){
	$("#loader").hide();

	$(".anadir").click(function(e){
		e.preventDefault();
		var tabla=$(this).parent().parent().attr('id'); //Obtiene el id del div que lo contiene sin tener en cuenta el div creado para el diseño
		if(tabla=="marcadores")
			window.location.href="listar.php?tabla=provincias&editable=true&borrable=false&sw=3";
		else
			window.location.href="anadir.php?tabla="+tabla+"&editable=false";
	});

	$(".editar").click(function(e){
		e.preventDefault();
		var tabla=$(this).parent().parent().attr('id'); //Obtiene el id del div que lo contiene sin tener en cuenta el div creado para el diseño
		if(tabla=="clubs"){
			window.location.href="listar.php?tabla=provincias&editable=true&borrable=false&sw=0"
		}
		else if(tabla=="equipos"){
			window.location.href="listar.php?tabla=provincias&editable=true&borrable=false&sw=1"
		}
		else if(tabla=="partidos"){
			window.location.href="listar.php?tabla=provincias&editable=true&borrable=false&sw=2";
		}
		else if(tabla=="marcadores"){
			window.location.href="listar.php?tabla=provincias&editable=true&borrable=false&sw=4";
		}
		else if(tabla=="noticias"){
			window.location.href="listar.php?tabla=provincias&editable=true&borrable=false&sw=9";
		}
		else if(tabla=="ofertas"){
			window.location.href="listar.php?tabla=patrocinadores&editable=true&borrable=false&sw=1";
		}
		else{
			window.location.href="listar.php?tabla="+tabla+"&editable=true&borrable=false";
		}
	});

	$(".borrar").click(function(e){
		e.preventDefault();
		var tabla=$(this).parent().parent().attr('id'); //Obtiene el id del div que lo contiene sin tener en cuenta el div creado para el diseño
		if(tabla=="clubs"){
			window.location.href="listar.php?tabla=provincias&editable=true&borrable=true&sw=0"
		}
		else if(tabla=="equipos"){
			window.location.href="listar.php?tabla=provincias&editable=true&borrable=true&sw=1"
		}
		else if(tabla=="partidos"){
			window.location.href="listar.php?tabla=provincias&editable=true&borrable=true&sw=2";
		}
		else if(tabla=="marcadores"){
			window.location.href="listar.php?tabla=provincias&editable=true&borrable=true&sw=4";
		}
		else if(tabla=="noticias"){
			window.location.href="listar.php?tabla=provincias&editable=true&borrable=true&sw=9";
		}
		else if(tabla=="patrocinadores"){
			window.location.href="listar.php?tabla=patrocinadores&editable=true&borrable=true&sw=0";
		}
		else if(tabla=="ofertas"){
			window.location.href="listar.php?tabla=patrocinadores&editable=true&borrable=true&sw=1";
		}
		else{
			window.location.href="listar.php?tabla="+tabla+"&editable=true&borrable=true";
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