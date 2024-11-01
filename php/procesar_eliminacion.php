<?php 
	require 'articulo_listado.php';
	require_once 'encabezado.php';
		if ($conexion && !empty($_GET['id'])) {
			$id = $_GET['id'];
			$consulta = 'DELETE FROM articulo WHERE id = ?';
			$sentencia = mysqli_prepare($conexion,$consulta);
			mysqli_stmt_bind_param($sentencia,'i',$id);
			$resultado=mysqli_execute($sentencia);
			header('refresh:0;url=articulo_listado.php');
		}

	

	
	require_once 'pie.php';
?>