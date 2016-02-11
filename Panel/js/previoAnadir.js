function comprobacion_previas(modal){
	switch(modal){
		case "clubs":
			$("#name").keyup(function() {
				var lon=$(this).val().trim().length;
				if(lon>0){
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#userInput .error").hide();
				}
				else{
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#userInput .error").show();
				}
			});
			break;
		case "equipos":
			$("#name").keyup(function() {
				var lon=$(this).val().trim().length;
				if(lon>0){
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#userInput .error").hide();
				}
				else{
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#userInput .error").show();
				}
			});
			break;
		case "partidos":
			$("#selectLocal").change(function(){
				var optSel = $("option:selected", this).text().split(' -')[0];
				if(optSel=="Ninguno"){
					$("#local").val("").removeAttr('readonly');
					$("#selectVis").css('background', '#fff').removeAttr('disabled');
				}
				else{
					$("#local").val(optSel).attr('readonly', 'readonly');
					$("#idequipo").val($("option:selected", this).attr("idequipo"));
					$("#selectVis").css('background', '#eee').attr('disabled', 'true');
				}
			});
			$("#selectVis").change(function(){
				var optSel = $("option:selected", this).text().split(' -')[0];
				if(optSel=="Ninguno"){
					$("#vis").val("").removeAttr('readonly');
					$("#selectLocal").css('background', '#fff').removeAttr('disabled');
				}
				else{
					$("#vis").val(optSel).attr('readonly', 'readonly');
					$("#idequipo").val($("option:selected", this).attr("idequipo"));
					$("#selectLocal").css('background', '#eee').attr('disabled', 'true');
				}
			});
			$("#local").keyup(function() {
				var lon=$(this).val().trim().length;
				if(lon>0){
					$("#selectLocal").css('background', '#eee').attr('disabled', 'true');
					$("#vis").attr('readonly', 'readonly');
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#localInput .error").hide();
				}
				else{
					$("#vis").val("").removeAttr('readonly');
					$("#selectLocal").css('background', '#fff').removeAttr('disabled');
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#localInput .error").show();
				}
			});
			$("#vis").keyup(function() {
				var lon=$(this).val().trim().length;
				if(lon>0){
					$("#selectVis").css('background', '#eee').attr('disabled', 'true');
					$("#local").attr('readonly', 'readonly');
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#visInput .error").hide();
				}
				else{
					$("#local").val(optSel).attr('readonly', 'readonly');
					$("#selectVis").css('background', '#eee').attr('disabled', 'true');
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#visInput .error").show();
				}
			});
			$("#fecha").change(function() {
				var lon=$(this).val().trim().length;
				if(lon>0){
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#fechaInput .error").hide();
				}
				else{
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#fechaInput .error").show();
				}
			});
			$("#hora").change(function() {
				var filter=/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
				if(filter.test($(this).val().trim())){
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#horaInput .error").hide();
				}
				else{
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#horaInput .error").show();
				}
			});
			break;
		case "marcadores":
			$("#local").keyup(function() {
				var lon=$(this).val().trim().length;
				if(lon>0){
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#localInput .error").hide();
				}
				else{
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#localInput .error").show();
				}
			});
			$("#vis").keyup(function() {
				var lon=$(this).val().trim().length;
				if(lon>0){
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#visInput .error").hide();
				}
				else{
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#visInput .error").show();
				}
			});
			break;
		case "users":
			$("#user").keyup(function(){
				var lon=$("#user").val().trim().length;
				if(lon>=4){
					$("#user").parent().removeClass("has-error");
					$("#user").parent().addClass("has-success");
					$("#userInput .error").hide();
				}
				else{
					$("#user").parent().removeClass("has-success");
					$("#user").parent().addClass("has-error");
					$("#userInput .error").show();
				}
			});

			$("#generaPass").click(function(e){
		    	e.preventDefault();
		    	$("#loader").show();
		    	var pass="";
		    	for(var i=0; i<8; i++){
		    		var caracts="1234567890QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm1234567890";
		    		pass+=caracts.charAt(Math.random()*caracts.length);
		    	}

		    	$("#passGenerada").text(pass);
		    	$("#pass").val(pass);
		    	$("#pass").parent().addClass("has-success");
		    	$("#passRepet").val(pass);
		    	$("#passRepet").parent().addClass("has-success");
		    	$("#loader").hide();
		    });

			$("#pass").keyup(function(){
				var filter=/^(?=.*[0-9])[a-zA-Z0-9!-_.@#$%^&*]{6,15}$/;
				if(filter.test($("#pass").val().trim())){
					$("#pass").parent().removeClass("has-error");
					$("#pass").parent().addClass("has-success");
					$("#passInput .error").hide();
				}
				else{
					$("#pass").parent().removeClass("has-success");
					$("#pass").parent().addClass("has-error");
					$("#passInput .error").show();
				}
			});

			$("#passRepet").keyup(function(){
				if($("#passRepet").val().trim()==$("#pass").val().trim()){
					$("#passRepet").parent().removeClass("has-error");
					$("#passRepet").parent().addClass("has-success");
					$("#passRepetInput .error").hide();
				}
				else{
					$("#passRepet").parent().removeClass("has-success");
					$("#passRepet").parent().addClass("has-error");
					$("#passRepetInput .error").show();
				}
			});
			break;
		case "noticias":
			$("#titulo").keyup(function() {
				var lon=$(this).val().trim().length;
				if(lon>0){
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#tituloInput .error").hide();
				}
				else{
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#tituloInput .error").show();
				}
			});
			$("#subtitulo").keyup(function() {
				var lon=$(this).val().trim().length;
				if(lon>0){
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#subtituloInput .error").hide();
				}
				else{
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#subtituloInput .error").show();
				}
			});
			$("#cuerpo").keyup(function() {
				var lon=$(this).val().trim().length;
				if(lon>0){
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#cuerpoInput .error").hide();
				}
				else{
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#cuerpoInput .error").show();
				}
			});
			break;
		case "patrocinadores":
			$("#empresa").keyup(function() {
				var lon=$(this).val().trim().length;
				if(lon>0){
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#empresaInput .error").hide();
				}
				else{
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#empresaInput .error").show();
				}
			});
			$("#maxOfertas").keyup(function() {
				var lon=$(this).val().trim().length;
				if(lon>0){
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#maxOfertasInput .error").hide();
				}
				else{
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#maxOfertasInput .error").show();
				}
			});
			break;
		case "ofertas":
			$("#selectPatro").change(function() {
				var lon=$(this).val().trim().length;
				if(lon>0){
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#patroInput .error").hide();
				}
				else{
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#patroInput .error").show();
				}
			});

			$("#mensaje").keyup(function() {
				var lon=$(this).val().trim().length;
				if(lon>0){
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#mensajeInput .error").hide();
				}
				else{
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#mensajeInput .error").show();
				}
			});

			$("#fechaFin").keyup(function() {
				var lon=$(this).val().trim().length;
				if(lon>0){
					$(this).parent().removeClass("has-error");
					$(this).parent().addClass("has-success");
					$("#fechaFinInput .error").hide();
				}
				else{
					$(this).parent().removeClass("has-success");
					$(this).parent().addClass("has-error");
					$("#fechaFinInput .error").show();
				}
			});
		break;
	}
}