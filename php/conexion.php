<?php 

function conectar()
{
	$servidor = 'localhost';
	$usuario = 'root';
	$pass = '';
	$bd = 'labo2';

	set_error_handler(function(){

	throw new Exception("Error");
	
	});

	try {
		$conectar = mysqli_connect($servidor,$usuario,$pass,$bd);
	}

	catch (Exception $e){
		$conectar = false;
	}

	return $conectar;
}

function desconectar($conexionBD)
{
	if ($conexionBD) {
		mysqli_close($conexionBD);
	}
	
}



?>