$(function(){
	var rutaImagen="";
	var tabla=location.search.split("tabla=")[1].split("&")[0];
	var id="";
	var passEditada="";
	$("#content .formulario").load("../forms/"+tabla+".php", function(response, status, xhr){
	  	if (status == "error") {
		    $("#loader").hide();
  		}
  		else{
  			var editable=location.search.split("editable=")[1].split("&")[0];
  			if(tabla=="marcadores"){
  				$("#loader").show();
  				if(editable=="true")
  					id=location.search.split("idpartido=")[1].split("&")[0];
  				else
  					id=location.search.split("id=")[1].split("&")[0];

  				$("#idpartido").val(id);
		    	$.ajax({
			        type: 'POST',
			        url: '../php/mostrarDatos.php',
			        data: 'modal=partidos&id='+id,
			        success:function(data){
			        	var local=data.split('local:')[1];
			    		local=local.split("+")[0];
			    		var visitante=data.split('visitante:')[1];
			    		visitante=visitante.split("+")[0];
			    		$("#title").append("<span>"+local+"</span>");
			    		$("#title").append("<span id='ptsLocText'></span>");
			    		$("#title").append("<span> - </span>");
			    		$("#title").append("<span id='ptsVisText'></span>");
			    		$("#title").append("<span>"+visitante+"</span>");
			        },
			        error: function(data){
			        	console.log(data);
			        }
			    });
  			}

  			if(editable=="true"){
  				if(tabla=="marcadores"){
  					id=location.search.split("idpartido=")[1].split("&")[0];
  				}
  				else{
  					id=location.search.split("id=")[1].split("&")[0];
  				}
  			
  				if(tabla=="users" && $(".nameUser").attr('permiso')!='A'){
  					if(id!=$(".nameUser").attr('iduser'))
  						window.location.href="anadir.php?tabla="+tabla+"&editable=true&id="+$(".nameUser").attr('iduser');
  				}
  				
  				$("#loader").show();
		    	$.ajax({
			        type: 'POST',
			        url: '../php/mostrarDatos.php',
			        data: 'modal='+tabla+'&id='+id,
			        success:function(data){
			        	switch(tabla){
			        		case "clubs":
					    		var nombreClub=data.split('nombre:')[1];
					    		nombreClub=nombreClub.split("+")[0];
					    		var provinciaClub=data.split('idprovincia:')[1];
					    		provinciaClub=provinciaClub.split("+")[0];
					    		var url=data.split('url:')[1];
					    		url=url.split("+")[0];
					    		var bb=data.split('bb:')[1];
					    		bb=bb.split("+")[0];
					    		$("#name").val(nombreClub);
					    		$("#provincia").val(provinciaClub);
					    		$("#url").val(url);
					    		if(bb==1)
					    			$("#bbSi").attr("checked", "checked");
					    		break;
					    	case "equipos":
					    		var nombreEquipo=data.split('nombre:')[1];
					    		nombreEquipo=nombreEquipo.split("+")[0];
					    		var idCat=data.split('idcat:')[1];
					    		idCat=idCat.split("+")[0];
					    		var idClub=data.split('idclub:')[1];
					    		idClub=idClub.split("+")[0];
					    		$("#name").val(nombreEquipo);
					    		$("#categoria").val(idCat);
					    		$("#club").val(idClub);
					    		break;
					    	case "partidos":
					    		var idequipo=data.split('idequipo:')[1];
					    		idequipo=idequipo.split("+")[0];
					    		var local=data.split('local:')[1];
					    		local=local.split("+")[0];
					    		var visitante=data.split('visitante:')[1];
					    		visitante=visitante.split("+")[0];
					    		var fechaHora=data.split('fecha:')[1];
					    		fechaHora=fechaHora.split("+")[0];
					    		var fecha=fechaHora.split(" ")[0];
					    		var hora=fechaHora.split(" ")[1];
					    		$("#idequipo").val(idequipo);
					    		$("#local").val(local);
					    		$("#vis").val(visitante);
					    		$("#fecha").val(fecha);
					    		$("#hora").val(hora);
					    		break;
					    	case "marcadores":
					    		var local=data.split('ptsLocal:')[1];
					    		local=local.split("+")[0];
					    		var visitante=data.split('ptsVis:')[1];
					    		visitante=visitante.split("+")[0];
					    		$("#local").val(local);
					    		$("#vis").val(visitante);
					    		$("#ptsLocText").text(" "+local);
					    		$("#ptsVisText").text(" "+visitante+" ");
					    		break;
					    	case "users":
					    		var user=data.split('nombre:')[1];
					    		user=user.split("+")[0];
					    		var pass=data.split('pass:')[1];
					    		pass=pass.split("+")[0];
					    		var permiso=data.split('permiso:')[1];
					    		permiso=permiso.split("+")[0];
					    		$("#user").val(user);
					    		$("#pass").val(pass);
					    		passEditada=pass;
					    		$("#passRepet").val(pass);
					    		$("#permiso").val(permiso);
					    		break;
					    	case "noticias":
					    		var idclub=data.split('idclub:')[1];
					    		idclub=idclub.split("+")[0];
					    		var titulo=data.split('titulo:')[1];
					    		titulo=titulo.split("+")[0];
					    		var subtitulo=data.split('subtitulo:')[1];
					    		subtitulo=subtitulo.split("+")[0];
					    		var cuerpo=data.split('cuerpo:')[1];
					    		cuerpo=cuerpo.split("+")[0];
					    		$("#club").val(idclub);
					    		$("#titulo").val(titulo);
					    		$("#subtitulo").val(subtitulo);
					    		$("#cuerpo").val(cuerpo);
					    		break;
					    	case "patrocinadores":
					    		var nombre=data.split('nombre:')[1];
					    		nombre=nombre.split("+")[0];
					    		var url=data.split('url:')[1];
					    		url=url.split("+")[0];
					    		var ofertas=data.split('ofertas:')[1];
					    		ofertas=ofertas.split("+")[0];
					    		$("#nombre").val(nombre);
					    		$("#url").val(url);
					    		$("#maxOfertas").val(ofertas);

					    		$('#aceptar').prop('disabled', false);
					    		break;
					    	case "ofertas":
					    		var idpatro=data.split('idpatro:')[1];
					    		idpatro=idpatro.split("+")[0];
					    		var patro=data.split('npatro:')[1];
					    		patro=patro.split("+")[0];
					    		var mensaje=data.split('mensaje:')[1];
					    		mensaje=mensaje.split("+")[0];
					    		var fechaFin=data.split('fechaFin:')[1];
					    		fechaFin=fechaFin.split("+")[0];
					    		var url=data.split('url:')[1];
					    		url=url.split("+")[0];
					    		$("#selectPatro").val(idpatro).prop("disabled", true);
					    		$("#mensaje").val(mensaje);
					    		$("#fechaFin").val(fechaFin);
					    		$("#url").val(url);
					    		break;
					    }
					    $("#loader").hide();
			        },
			        error:function(err){
			        	$("#errorAnadir").show();
			            $("#loader").hide();
			        }
			    });
  			}
  			
			$("#loader").hide();

			comprobacion_previas(tabla);

			$("#subir").click(function(e){
		    	e.preventDefault();
		    	$("#loader").show();
		    	var formData=new FormData($("#imgForm")[0]);
		    	var carpeta="";
		    	switch(tabla){
		    		case "noticias":
		    			carpeta="news";
		    			break;
		    		case "ofertas":
		    			carpeta="ofertas";
		    			break;
		    		case "patrocinadores":
		    			carpeta="patros";
		    			break;
		    	}
		    	$.ajax({
			        type: 'POST',
			        url: '../php/subirImagen.php?carpeta='+carpeta,
			        processData: false,
			        cache: false,
            		contentType: false,
			        data: formData,
			        success:function(data){
			        	if(data!=""){
			        		rutaImagen=data;
			        		$("#aceptar").prop('disabled', false);
			        		$("#loader").hide();
			        		$("#errorSubida").hide();
			        	}
			        	else{
			        		$("#errorSubida").hide();
				        	$("#errorSubida").show();
				        	$("#loader").hide();
			        	}
			        },
			        error:function(err){
			        	console.log("Error: "+err);
			        	$("#loader").hide();
			        }
			    });
		    });

			$("#aceptar").click(function(e){
				e.preventDefault();
				$("#loader").show();
				if(test_registro(tabla)){
					var formData=new FormData($("#formulario")[0]);
					formData.append("imagen", rutaImagen);
					var mData="";
					if(tabla=="users" && passEditada!="" && passEditada==$("#pass").val())
						mData="&noPassEdit=1";

					$.ajax({
				        type: 'POST',
				        url: '../php/anadir.php?tabla='+tabla+"&editable="+editable+"&id="+id+mData,
				        processData: false,
				        cache: false,
	            		contentType: false,
				        data: formData,
				        success:function(data){
				        	if(data==1){
				        		if(tabla=='ofertas' || tabla=='marcadores'){
				            		var dataPush="";
				            		if(tabla=='ofertas'){
				            			dataPush='catNom=0&modal=ofertas&message='+$('#mensaje').val()+'&title='+$('#idpatro option:selected').text()+'&imagen='+rutaImagen;
				            		}
				            		else{
				            			dataPush='modal=marcadores&idpartido='+id;
				            		}
				            		$.ajax({
								        type: 'POST',
								        url: '../php/gcm.php',
								        data: dataPush,
								        success:function(res){
								            history.back();
								        },
								        error:function(err){
								        	$("#loader").hide();
								        	$("#errorAnadir").hide();
								        	$("#errorAnadir").show();
								        }
								    });
				            	}
				            	else
				        			history.back();
				        	}
				        	else{
				        		$("#errorDatos").hide();
				        		$("#errorDatos").show();
				        		$("#loader").hide();
				        	}
				        },
				        error:function(err){
				        	$("#errorAnadir").hide();
				        	$("#errorAnadir").show();
				        	$("#loader").hide();
				        }
				    });
				}
				else{
					$("#errorDatos").hide();
	        		$("#errorDatos").show();
	        		$("#loader").hide();
				}
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