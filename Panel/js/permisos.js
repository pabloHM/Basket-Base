$(function(){
	if($(".nameUser").attr('permiso')!='A'){
		$(".editar").click(function(e){
			var tabla=$(this).parent().parent().attr('id');
			if(tabla=="users"){
				window.location.href="anadir.php?tabla="+tabla+"&editable=true&id="+$(".nameUser").attr('iduser');
			}
		});
		if($(".nameUser").attr('permiso')!='S'){
			$("#clubs").hide();
			$("#equipos").hide();
			$("#users .anadir").hide();
			$("#users .borrar").hide();
			$("#ofertas").hide();
			$("#patrocinadores").hide();
			$("#partidos .borrar").parent().hide();
			$("#noticias .borrar").parent().hide();
		}
		else{
			$("#clubs").hide();
			$("#equipos").hide();
			$("#users .anadir").hide();
			$("#users .borrar").hide();
			$("#patrocinadores").hide();
			$("#noticias").hide();
			$("#partidos").hide();
			$("#marcadores").hide();
			$("#ofertas .editar").hide();
			$("#ofertas .borrar").hide();
		}
	}
});