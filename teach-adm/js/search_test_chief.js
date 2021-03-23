$(search_test());

function search_test(consulta){
	$.ajax({
		url: 'search/search_test_chief.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(respuesta){
		$('#data1').html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});
}

$(document).on('keyup', '#search_box1', function(){
	var valor = $(this).val();
	if(valor != ""){
		search_test(valor);
	}
	else{
		search_test();
	}
});