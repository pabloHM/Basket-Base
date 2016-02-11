function test_registro(modal){
	var registrable=false, total=-1, cont=0;

	switch(modal){
		case "clubs":
			total=1;
			cont=0;

			var lon=$("#name").val().trim().length;
			if(lon>0){
				$(this).parent().removeClass("has-error");
				$(this).parent().addClass("has-success");
				$("#nameInput .error").hide();
				cont++;
			}
			else{
				$(this).parent().removeClass("has-success");
				$(this).parent().addClass("has-error");
				$("#nameInput .error").show();
				cont=0;
			}
		break;
		case "equipos":
			total=1;
			cont=0;

			var lon=$("#name").val().trim().length;
			if(lon>0){
				$(this).parent().removeClass("has-error");
				$(this).parent().addClass("has-success");
				$("#userInput .error").hide();
				cont++;
			}
			else{
				$(this).parent().removeClass("has-success");
				$(this).parent().addClass("has-error");
				$("#userInput .error").show();
				cont=0;
			}
		break;
		case "partidos":
			total=4;
			cont=0;

			var lon=$("#local").val().trim().length;
			if(lon>0){
				$(this).parent().removeClass("has-error");
				$(this).parent().addClass("has-success");
				$("#localInput .error").hide();
				cont++;
			}
			else{
				$(this).parent().removeClass("has-success");
				$(this).parent().addClass("has-error");
				$("#localInput .error").show();
				cont=0;
			}

			lon=$("#vis").val().trim().length;
			if(lon>0){
				$(this).parent().removeClass("has-error");
				$(this).parent().addClass("has-success");
				$("#visInput .error").hide();
				cont++;
			}
			else{
				$(this).parent().removeClass("has-success");
				$(this).parent().addClass("has-error");
				$("#visInput .error").show();
				cont=0;
			}

			lon=$("#fecha").val().trim().length;
			if(lon>0){
				$(this).parent().removeClass("has-error");
				$(this).parent().addClass("has-success");
				$("#fechaInput .error").hide();
				cont++;
			}
			else{
				$(this).parent().removeClass("has-success");
				$(this).parent().addClass("has-error");
				$("#fechaInput .error").show();
				cont=0;
			}

			lon=$("#hora").val().trim().length;
			if(lon>0){
				$(this).parent().removeClass("has-error");
				$(this).parent().addClass("has-success");
				$("#horaInput .error").hide();
				cont++;
			}
			else{
				$(this).parent().removeClass("has-success");
				$(this).parent().addClass("has-error");
				$("#horaInput .error").show();
				cont=0;
			}
		break;
		case "marcadores":
			total=2;
			cont=0;

			var lon=$("#local").val().trim().length;
			if(lon>0){
				$(this).parent().removeClass("has-error");
				$(this).parent().addClass("has-success");
				$("#localInput .error").hide();
				cont++;
			}
			else{
				$(this).parent().removeClass("has-success");
				$(this).parent().addClass("has-error");
				$("#localInput .error").show();
				cont=0;
			}

			lon=$("#vis").val().trim().length;
			if(lon>0){
				$(this).parent().removeClass("has-error");
				$(this).parent().addClass("has-success");
				$("#visInput .error").hide();
				cont++;
			}
			else{
				$(this).parent().removeClass("has-success");
				$(this).parent().addClass("has-error");
				$("#visInput .error").show();
				cont=0;
			}
		break;
		case "users":
			total=3;
			cont=0;

			var lon=$("#user").val().trim().length;
			if(lon>=4){
				$("#user").parent().removeClass("has-error");
				$("#user").parent().addClass("has-success");
				$("#userInput .error").hide();
				cont++;
			}
			else{
				$("#user").parent().removeClass("has-success");
				$("#user").parent().addClass("has-error");
				$("#userInput .error").show();
				cont=0;
			}

			var filter=/^(?=.*[0-9])[a-zA-Z0-9!-_.@#$%^&*]{6,15}$/;
			if(filter.test($("#pass").val().trim())){
				$("#pass").parent().removeClass("has-error");
				$("#pass").parent().addClass("has-success");
				$("#passInput .error").hide();
				cont++;
			}
			else{
				$("#pass").parent().removeClass("has-success");
				$("#pass").parent().addClass("has-error");
				$("#passInput .error").show();
				cont=0;
			}

			if($("#passRepet").val().trim()==$("#pass").val().trim()){
				$("#passRepet").parent().removeClass("has-error");
				$("#passRepet").parent().addClass("has-success");
				$("#passRepetInput .error").hide();
				cont++;
			}
			else{
				$("#passRepet").parent().removeClass("has-success");
				$("#passRepet").parent().addClass("has-error");
				$("#passRepetInput .error").show();
				cont=0;
			}
		break;
		case "noticias":
			total=3;
			cont=0;

			var lon=$("#titulo").val().trim().length;
			if(lon>0){
				$(this).parent().removeClass("has-error");
				$(this).parent().addClass("has-success");
				$("#tituloInput .error").hide();
				cont++;
			}
			else{
				$(this).parent().removeClass("has-success");
				$(this).parent().addClass("has-error");
				$("#tituloInput .error").show();
				cont=0;
			}

			lon=$("#subtitulo").val().trim().length;
			if(lon>0){
				$(this).parent().removeClass("has-error");
				$(this).parent().addClass("has-success");
				$("#subtituloInput .error").hide();
				cont++;
			}
			else{
				$(this).parent().removeClass("has-success");
				$(this).parent().addClass("has-error");
				$("#subtituloInput .error").show();
				cont=0;
			}

			lon=$("#cuerpo").val().trim().length;
			if(lon>0){
				$(this).parent().removeClass("has-error");
				$(this).parent().addClass("has-success");
				$("#cuerpoInput .error").hide();
				cont++;
			}
			else{
				$(this).parent().removeClass("has-success");
				$(this).parent().addClass("has-error");
				$("#cuerpoInput .error").show();
				cont=0;
			}
		break;
		case "ofertas":
			total=2;
			cont=0;

			lon=$("#mensaje").val().trim().length;
			if(lon>0){
				$(this).parent().removeClass("has-error");
				$(this).parent().addClass("has-success");
				$("#mensajeInput .error").hide();
				cont++;
			}
			else{
				$(this).parent().removeClass("has-success");
				$(this).parent().addClass("has-error");
				$("#mensajeInput .error").show();
				cont=0;
			}

			lon=$("#fechaFin").val().trim().length;
			if(lon>0){
				$(this).parent().removeClass("has-error");
				$(this).parent().addClass("has-success");
				$("#fechaFinInput .error").hide();
				cont++;
			}
			else{
				$(this).parent().removeClass("has-success");
				$(this).parent().addClass("has-error");
				$("#fechaFinInput .error").show();
				cont=0;
			}
		break;
		case "patrocinadores":
			total=2;
			cont=0;

			var lon=$("#nombre").val().trim().length;
			if(lon>0){
				$(this).parent().removeClass("has-error");
				$(this).parent().addClass("has-success");
				$("#empresaInput .error").hide();
				cont++;
			}
			else{
				$(this).parent().removeClass("has-success");
				$(this).parent().addClass("has-error");
				$("#empresaInput .error").show();
				cont=0;
			}

			lon=$("#maxOfertas").val().trim().length;
			if(lon>0){
				$(this).parent().removeClass("has-error");
				$(this).parent().addClass("has-success");
				$("#maxOfertasInput .error").hide();
				cont++;
			}
			else{
				$(this).parent().removeClass("has-success");
				$(this).parent().addClass("has-error");
				$("#maxOfertasInput .error").show();
				cont=0;
			}
		break;
	}
	
	if(cont===total)
		registrable=true;

	return registrable;
}