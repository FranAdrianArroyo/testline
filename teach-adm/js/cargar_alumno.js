$(document).ready(function(){

	$('.enviar_archivoalumno').on( "click", function(evt) {

		evt.preventDefault();
		cargarArchivoCSV();

	});

});

function cargarArchivoCSV()
{

	var archivo 		  = $('input[name=archivoalumno_csv]').val();
	var extension		  = $('#archivoalumno_csv').val().split(".").pop().toLowerCase();
	var Formulario		  = document.getElementById('frmSubirAlumnoCSV');
	var dataForm		  = new FormData(Formulario);

	var retornarError     = false;

	if(archivo=="")
	{
		$('#archivoalumno_csv').addClass('error');
		retornarError = true;
		$('#archivoalumno_csv').focus();
	} 
	else if($.inArray(extension, ['csv']) == -1)
	{
		alert("¡El archivo que esta tratando de subir es invalido!");
		retornarError = true;
		$('#archivoalumno_csv').val("");
	}
	else
	{
		$('#archivoalumno_csv').removeClass('error');
	}

    // A continuacion se resalta todos los campos que contengan errores.
    if(retornarError == true)
    {
        return false;
    }

    $.ajax({

		url: 'upload_csv/procesar_alumno.php',
		type: 'POST',
		data: dataForm,
		cache: false,
		contentType: false,
		processData: false,
        beforeSend: function(){
            $('#estado').prepend('<p><img src="images/facebook.gif" /></p>');
        },
        success: function(data){
            $('#estado').fadeOut("fast",function()
            {
                $('#estado').html(data);
            });
            
            $('#estado').fadeIn("slow");
            $("#frmSubirAlumnoCSV").find('input[type=file]').val("");

        },
		error: function (jqXHR, textStatus, errorThrown) {
		    $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
		}

    });


}