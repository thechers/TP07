<?php 
	require_once 'encabezado.php';
	require 'conexion.php';
	if (!empty($_POST['nombre']) && !empty($_POST['categoria']) && !empty($_POST['precio'])) {
			
			$nombre = $_POST['nombre'];
			$cat = $_POST['categoria'];
			$precio = $_POST['precio'];

		
			if (!empty($_FILES['imagen']['size'])) {
				$conexion = conectar();
				$nombre_img = $_FILES['imagen']['name'];
				$origen = $_FILES['imagen']['tmp_name'];
				$destino = '../img/articulos/';


				move_uploaded_file($origen, $destino.$nombre_img);

				$foto = $nombre_img;

				$interaccion = 'INSERT INTO articulo(nombre,categoria,precio,foto) VALUES (?,?,?,?)';

				$sentencia = mysqli_prepare($conexion,$interaccion);
				mysqli_stmt_bind_param($sentencia,'ssis',$nombre,$cat,$precio,$foto);

				$guardado = mysqli_execute($sentencia);

					if ($guardado) {
					header('refresh:1;url=articulo_listado.php');
					echo '<p>Guardado Exitoso.</p>';

					}

					else 
					{	
					header('refresh:2;url=articulo_alta.php');
					echo '<p>Fallo al guardar.</p>';
					}

			}

			else{


			}
				
		}
				

				/*Dado que la carpeta de destino ya se encuentra creada no hago la verificacion con file_exist */
				
		
	else
		{
			echo '<p>Faltan datos, reitente nuevamente.</p>';
		}

		require_once 'pie.php';
?>