$(search_student());

function search_student(consulta){
	$.ajax({
		url: 'search/search_student.php',
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
		search_student(valor);
	}
	else{
		search_student();
	}
});