<?php 
	require_once 'encabezado.php';
	require 'conexion.php';
		if (!empty($_GET['id'])) {
			$conexion = conectar();
			$id = $_GET['id'];
			$consulta = 'DELETE FROM articulo WHERE id_articulo = ?';
			$sentencia = mysqli_prepare($conexion,$consulta);
			mysqli_stmt_bind_param($sentencia,'i',$id);
			$resultado=mysqli_execute($sentencia);
			header('refresh:0;url=articulo_listado.php');
		}

	

	
	require_once 'pie.php';
?>