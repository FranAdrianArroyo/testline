$(search_jefe());

function search_jefe(consulta){
	$.ajax({
		url: 'search/search_jefe.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(respuesta){
		$('#data').html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});
}

$(document).on('keyup', '#search_box', function(){
	var valor = $(this).val();
	if(valor != ""){
		search_jefe(valor);
	}
	else{
		search_jefe();
	}
});