$(function(){
	$("#selectLocal").change(function(){
		console.log("HOLIII");
		var optSel = $("option:selected", this).text().split(' -')[0];
		if(optSel=="Ninguno"){
			$("#local").val("").removeAttr('disabled');
			$("#selectVis").css('background', '#fff').removeAttr('disabled');
		}
		else{
			$("#local").val(optSel).attr('disabled', 'true');
			$("#selectVis").css('background', '#eee').attr('disabled', 'true');
		}
	});
	$("#selectVis").change(function(){
		var optSel = $("option:selected", this).text().split(' -')[0];
		if(optSel=="Ninguno"){
			$("#vis").val("").removeAttr('disabled');
			$("#selectLocal").css('background', '#fff').removeAttr('disabled');
		}
		else{
			$("#vis").val(optSel).attr('disabled', 'true');
			$("#selectLocal").css('background', '#eee').attr('disabled', 'true');
		}
	});
});