<?php

	include_once '../../dbConnection.php';

	if(substr($_FILES['archivo_csv']['name'], -3)=="csv")
	{
		
		$n_archivo  = $_FILES['archivo_csv']['name'];

		$row = 1;

		move_uploaded_file($_FILES['archivo_csv']['tmp_name'],$n_archivo);

		$fp = fopen($n_archivo, "r");

		while($data = fgetcsv($fp, 1000, ","))
		{

			// Si la variable $row es diferente a 1, que no registre los titulos en la tabla
			if($row!=1)
			{
				$pass = md5($data[2]);
				$sql_archivo  = "INSERT INTO teacher(employnumber,name,password)";
				$sql_archivo  .= "VALUES('$data[0]','$data[1]','$pass')";

				$rpta_archivo = mysqli_query($con,$sql_archivo) or die("Error al registrar a los profesores");

				if(!$sql_archivo)
				{
					echo "<p>Hubo un problema al momento de importar el archivo. Por favor vuelva a intentarlo</p>";
					exit;					
				}

			}

		$row++;

		}

		fclose($fp);
		unlink("$n_archivo");

		echo "<p>La importacion del archivo CSV se ha subido satisfactoriamente</p>";

		exit();

	}