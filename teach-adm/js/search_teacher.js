$(search_teacher());

function search_teacher(consulta){
	$.ajax({
		url: 'search/search_teacher.php',
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
		search_teacher(valor);
	}
	else{
		search_teacher();
	}
});